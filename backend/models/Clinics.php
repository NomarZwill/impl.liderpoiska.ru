<?php

namespace backend\models;

use Yii;
use backend\models\Ratings;

/**
 * This is the model class for table "clinics".
 *
 * @property int $clinic_id
 * @property string $clinic_title
 * @property string $clinic_long_title
 * @property string $clinic_description
 * @property string $alias
 * @property string $menu_title
 * @property string $content
 * @property string $clinic_address
 * @property string $clinic_phone
 * @property string $clinic_opening_hours
 * @property string $clinic_map
 * @property string $main_phone
 * @property string $keywords
 * @property string $review_to_filial
 * @property string $review_title
 * @property string $bottom_text
 * @property int $old_id
 */
class Clinics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clinics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clinic_title', 'clinic_long_title', 'clinic_description', 'alias', 'old_id'], 'required'],
            [['clinic_title', 'clinic_long_title', 'clinic_description', 'alias', 'menu_title', 'content', 'clinic_address', 'clinic_phone', 'clinic_opening_hours', 'clinic_map', 'main_phone', 'keywords', 'review_to_filial', 'review_title', 'bottom_text'], 'string'],
            [['old_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clinic_id' => 'ID',
            'clinic_title' => 'Название',
            'clinic_long_title' => 'Полное название',
            'clinic_description' => 'Описание клиники',
            'alias' => 'Alias',
            'menu_title' => 'Название для меню',
            'content' => 'Контент',
            'clinic_address' => 'Адрес',
            'clinic_phone' => 'Телефоны',
            'clinic_opening_hours' => 'Часы работы',
            'clinic_map' => 'Карта',
            'main_phone' => 'Основной телефон',
            'keywords' => 'Ключевые слова',
            'review_to_filial' => 'Review To Filial',
            'review_title' => 'Review Title',
            'bottom_text' => 'Bottom Text',
            'old_id' => 'Old ID',
        ];
    }

    public function getRatings()
    {
        return $this->hasMany(Ratings::className(), ['clinic_id' => 'clinic_id']);
    }
}
