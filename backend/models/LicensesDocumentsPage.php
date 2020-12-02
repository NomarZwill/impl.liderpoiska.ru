<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

/**
 * This is the model class for table "licenses_documents_page".
 *
 * @property int $id
 * @property string $documents
 */
class LicensesDocumentsPage extends \yii\db\ActiveRecord
{
    public $licenses_gallery_images;
    public $documents_list;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licenses_documents_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documents'], 'string'],
            [['licenses_gallery_images', 'documents_list'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'documents' => 'Документы',
            'licenses_gallery_images' => 'Лицензии для загрузки',
            'documents_list' => 'Документы для загрузки',
        ];
    }

    public function uploadImages()
    {
        //if ($this->validate()) {
        $iter = 1;
        foreach ($this->licenses_gallery_images as $file) {
            $path = 'images/uploaded/licensesDocumentsPage/licenses/';
            FileHelper::createDirectory($path);
            $file_name = time() . '_' . $iter . '.' . $file->extension;
            $file->saveAs($path . $file_name);

            $alias_front = Yii::getAlias('@frontend/web');
            Image::getImagine()
                ->open($alias_front . '/' . $path . $file_name)
                ->thumbnail(new Box(192, 270))
                ->save($alias_front . '/' . $path . 'thumbnail_' . $file_name , ['quality' => 90]);

            $gallery = new LicensePageGalleries();
            $gallery->gallery_type = 'licenses';
            $gallery->parent_id = $this->id;
            $gallery->filepath = $file_name;
            $gallery->save();
            $iter++;     
        }
        return true;
        //} else {
        //    return false;
        //}
    }

    public function uploadDocuments()
    {
        //if ($this->validate()) {
        $iter = 1;
        foreach ($this->documents_list as $file) {
            $path = 'images/uploaded/licensesDocumentsPage/documents/';
            FileHelper::createDirectory($path);
            $file->saveAs($path . $file->baseName . '.' . $file->extension);
            $gallery = new LicensePageGalleries();
            $gallery->gallery_type = 'documents';
            $gallery->parent_id = $this->id;
            $gallery->filepath = $file->baseName . '.' . $file->extension;
            $gallery->save();
            $iter++;     
        }
        return true;
        //} else {
        //    return false;
        //}
    }

    public function getLicenses()
    {
        return $this->hasMany(LicensePageGalleries::className(), ['parent_id' => 'id'])
            ->where(['gallery_type' => 'licenses']);
    }
}
