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
            'name' => 'Название (Рейтинг-клиника)',
            'icon' => 'Иконка',
            'link_to_agregator' => 'Ссылка на страницу клиники (на агрегаторе)',
            'average_rating' => 'Средняя оценка',
            'clinic_id' => 'Название клиники',
            'icon_img' => 'Загрузить иконку',
            'is_active' => 'Активный',
        ];
    }

    public function uploadImage()
    {
        if ($this->validate()) {

            if (!empty($this->icon_img)) {
                
                foreach ($this->icon_img as $file) {
                    $path = 'images/uploaded/ratings/'. $this->id . '/';
                    FileHelper::createDirectory($path);
                    $file->saveAs($path . time() . '.' . $file->extension);
                    $this->icon = time() . '.' . $file->extension;
                }
            }
            return true;
        } else {
            return $this->validate();
        }
    }
}
