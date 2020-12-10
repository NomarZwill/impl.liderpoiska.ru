<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "ratings".
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $link_to_agregator
 * @property double $average_rating
 * @property string $clinic_id
 */
class Ratings extends \yii\db\ActiveRecord
{
    public $icon_img;

    const RATINGS_IMAGES_LIST = [
        1 => 'yell.png',
        2 => 'flamp.png',
        3 => 'google.png',
        4 => 'yandex.png',
        5 => 'zoon.png',
        6 => 'prodoctorov.png',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ratings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['name', 'icon', 'link_to_agregator', 'average_rating', 'clinic_id'], 'required'],
            [['name', 'icon', 'link_to_agregator', 'clinic_id'], 'string'],
            [['is_active', 'rating_name'], 'integer'],
            [['average_rating'], 'number'],
            [['icon_img'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rating_name' => 'Рейтинг',
            'name' => 'Название (Рейтинг-клиника)',
            'icon' => 'Иконка',
            'link_to_agregator' => 'Ссылка на страницу клиники (на агрегаторе)',
            'average_rating' => 'Средняя оценка',
            'clinic_id' => 'Название клиники',
            'icon_img' => 'Загрузить иконку',
            'is_active' => 'Активный',
        ];
    }

    // public function uploadImage()
    // {
    //     if ($this->validate()) {

    //         if (!empty($this->icon_img)) {
                
    //             foreach ($this->icon_img as $file) {
    //                 $path = 'images/uploaded/ratings/'. $this->id . '/';
    //                 FileHelper::createDirectory($path);
    //                 $file->saveAs($path . time() . '.' . $file->extension);
    //                 $this->icon = time() . '.' . $file->extension;
    //             }
    //         }
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function setRatingImage()
    {
        $image = Ratings::RATINGS_IMAGES_LIST[$this->rating_name];

        if (isset($image) && $image !== $this->icon){
            $this->icon = $image;
            $this->save();
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->setRatingImage();

        parent::afterSave($insert, $changedAttributes);
    }
}
