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
            [['parent_id', 'img_sort'], 'integer'],
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
            'img_sort' => 'Img sort',
            'filepath' => 'Filepath',
        ];
    }

    public function updateSortIndex($clinicID, $deleteImageSortIndex) {
        $images = ImageGalleries::find()
            ->where(['parent_id' => $clinicID, 'parent_type' => 'clinics'])
            ->all();

        foreach ($images as $image){
            if ($image->img_sort > $deleteImageSortIndex) {
                $image->img_sort -= 1;
                $image->save();
            }
        }
    }
}
