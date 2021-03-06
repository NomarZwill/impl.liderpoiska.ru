<?php

namespace common\html_constructor\models;


use Yii;
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\base\Exception;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "hc_file".
 */
class HcFile extends \yii\db\ActiveRecord
{

    const THUMB_CONFIG = [
        'width' => 2000,
        'height' => 2000,
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hc_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file', 'file_ext', 'folder'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'file' => Yii::t('models', 'File'),
            'file_ext' => Yii::t('models', 'File Ext'),
            'folder' => Yii::t('models', 'Folder'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHcObjectFile()
    {
        return $this->hasMany(\common\html_constructor\models\HcObjectFile::class, ['file_id' => 'id']);
    }

    private function getThumbnail($config)
    {
        try {
            return EasyThumbnailImage::thumbnailFileUrl(
                $this->getSystemPath(),
                $config['width'],
                $config['height'],
                EasyThumbnailImage::THUMBNAIL_INSET_BOX,
                $config['quality'] ?? null
            );
        } catch (\himiklab\thumbnail\FileNotFoundException $th) {
            return null;
        }
       
    }

    public function getWebFileLink($config = [], $full = false)
    {
        if (!empty($config) && in_array(strtolower($this->file_ext), ['jpg', 'png', 'jpeg', 'bmp'])) { //imagick doing bad on svgs
            $config = ArrayHelper::merge(self::THUMB_CONFIG, $config);
            return $this->getThumbnail($config);
        }
        return ($full ? \Yii::$app->params['siteProtocol'] . '://' . Yii::$app->params['siteAddress'] : '') 
        . '/' . Yii::$app->params['uploadFolder'] 
        . '/' . $this->folder 
        . '/' . $this->file;
    }

    public function getSystemPath()
    {
        return implode(DIRECTORY_SEPARATOR, [Yii::$app->params['uploadSystemPath'], $this->folder, $this->file]);
    }

    public static function upload($file, $hcFileTarget)
    {
        if (is_array($file)) {
            $folder = $hcFileTarget->hcObject->table_name . DIRECTORY_SEPARATOR . $hcFileTarget->type;
            $model = new HcFile();
            $filenameExploded = (explode('.', $file['name']));
            if (count($filenameExploded) == 2) {
                $name = $filenameExploded[0];
                $ext = $filenameExploded[1];
            } else if (count($filenameExploded) > 2) {
                $ext = end($filenameExploded);
                $name = implode('_', array_slice($filenameExploded, 0, count($filenameExploded) - 1));
            } else if (empty($filenameExploded)) {
                $name = 'untitled' . time();
                $ext = '';
            } else if (count($filenameExploded) == 1) {
                $name = $filenameExploded[0];
                $ext = '';
            }
            $name = Inflector::transliterate($name);
            $filename = date('H-i-s_') . $name . (empty($ext) ? '' : '.' . $ext);
            $model->file = $filename;
            $model->file_ext = $ext;
            $model->folder = $folder;
            $dir = implode(DIRECTORY_SEPARATOR, [Yii::$app->params['uploadSystemPath'], $folder]);
            $mkdir = FileHelper::createDirectory($dir);
            $savePath = implode(DIRECTORY_SEPARATOR, [$dir, $filename]);
            $copy = copy($file['tmp_name'], $savePath);
            if ($mkdir) {
                if ($copy) {
                    if ($model->save()) {
                        return $model;
                    } else {
                        throw new Exception('???????????? ????????????????????');
                    }
                } else {
                    throw new Exception('???????????? ?????????????????????? ??????????');
                }
            } else {
                throw new Exception('???????????? ???????????????? ???????????????? '. $dir);
            }
        } else throw new Exception('Php file is not array');
    }

    public function getFileTypeForPreview()
    {
        $variants = [
            "image" => "/\.(gif|png|jpe?g|svg)$/i",
            // "text" => "/\.(txt|md|csv|nfo|php|ini)$/i",
            "video" => "/\.(og?|mp4|webm)$/i",
            "audio" => "/\.(ogg|mp3|wav)$/i",
            "flash" => "/\.(swf)$/i",
            "pdf" => "/\.(pdf)$/i",
        ];

        foreach ($variants as $type => $pattern) {
            if (preg_match($pattern, $this->file)) {
                return  $type;
            }
        }

        return 'other';
    }

    public function beforeDelete()
    {
        unlink($this->getSystemPath());
        return parent::beforeDelete();
    }
}
