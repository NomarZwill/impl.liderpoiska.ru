<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "image_galleries".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $parent_type
 * @property string $filepath
 */
class ImageGalleries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image_galleries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'parent_type', 'filepath'], 'required'],
            [['parent_id'], 'integer'],
            [['parent_type', 'filepath'], 'string'],
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
            'parent_type' => 'Parent Type',
            'filepath' => 'Filepath',
        ];
    }
}
