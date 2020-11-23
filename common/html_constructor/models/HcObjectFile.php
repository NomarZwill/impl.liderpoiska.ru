<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\html_constructor\models;


use Yii;

/**
 * This is the base-model class for table "hc_object_file".
 *
 * @property integer $id
 * @property integer $file_target_id
 * @property integer $file_id
 * @property string $description
 * @property integer $sort
 *
 * @property \common\html_constructor\models\File $file
 * @property \common\html_constructor\models\HcObjectFileTarget $hcFileTarget
 * @property string $aliasModel
 */
class HcObjectFile extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hc_object_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_target_id', 'file_id', 'sort'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\html_constructor\models\HcFile::class, 'targetAttribute' => ['file_id' => 'id']],
            [['file_target_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\html_constructor\models\HcObjectFileTarget::class, 'targetAttribute' => ['file_target_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'file_target_id' => Yii::t('models', 'File Target ID'),
            'file_id' => Yii::t('models', 'File ID'),
            'description' => Yii::t('models', 'Description'),
            'sort' => Yii::t('models', 'Sort'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(\common\html_constructor\models\HcFile::class, ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileTarget()
    {
        return $this->hasOne(\common\html_constructor\models\HcObjectFileTarget::class, ['id' => 'file_target_id']);
    }

    public function beforeDelete()
    {
        return parent::beforeDelete();
    }
    
    public function afterDelete()
    {
        parent::afterDelete();
        if($this->file && count($this->file->hcObjectFile) == 0) {
            $this->file->delete();
        }
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $lastFileOfTarget = self::find()
                ->where(['file_target_id' => $this->file_target_id])
                ->orderBy(['sort' => SORT_DESC])
                ->one();
            $newSort = empty($lastFileOfTarget) ? 1 : $lastFileOfTarget->sort + 1;
            $this->sort = $newSort;
        }
        return parent::beforeSave($insert);
    }
}