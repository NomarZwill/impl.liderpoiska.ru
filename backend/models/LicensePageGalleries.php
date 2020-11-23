<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "license_page_galleries".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $gallery_type
 * @property string $filepath
 */
class LicensePageGalleries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'license_page_galleries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['gallery_type', 'filepath'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'gallery_type' => 'Gallery Type',
            'filepath' => 'Filepath',
        ];
    }
}
