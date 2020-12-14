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
        'Yell' => 'yell.png',
        'Flamp' => 'flamp.png',
        'Google' => 'google.png',
        'Yandex' => 'yandex.png',
        'Zoon' => 'zoon.png',
        'ПроДокторов' => 'prodoctorov.png',
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
            [['name', 'icon', 'link_to_agregator', 'clinic_id', 'rating_name'], 'string'],
            [['is_active'], 'integer'],
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
            'name' => 'Клиника',
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

        // print_r($this->rating_name);
        // exit;

        if (isset($image) && $image !== $this->icon){
            $this->icon = $image;
            $this->save();
        }
    }

    public function setClinicName()
    {
        $clinicName = Clinics::findOne($this->clinic_id)->h1_title;
        if ($this->name !== $clinicName){
            $this->name = $clinicName;
            $this->save();
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->setRatingImage();
        $this->setClinicName();

        parent::afterSave($insert, $changedAttributes);
    }
}
