<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "servises".
 *
 * @property int $servise_id
 * @property string $servise_title
 * @property string $servise_long_title
 * @property string $servise_description
 * @property string $introtext
 * @property string $alias
 * @property string $menu_title
 * @property string $content
 * @property string $head_text
 * @property string $service_to_price_list
 * @property string $price_to_service
 * @property string $medic_to_service
 * @property string $review_to_service
 * @property string $query_to_service
 * @property string $padej_predl
 * @property string $keywords
 * @property string $price_title
 * @property string $review_title
 * @property string $faq_title
 * @property string $medic_title
 * @property int $parent_id
 * @property int $old_id
 */
class Servises extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servises';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['servise_title', 'servise_long_title', 'servise_description', 'introtext', 'alias', 'menu_title', 'content', 'head_text', 'service_to_price_list', 'price_to_service', 'medic_to_service', 'review_to_service', 'query_to_service', 'padej_predl', 'keywords', 'price_title', 'review_title', 'faq_title', 'medic_title'], 'string'],
            [['parent_id', 'old_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'servise_id' => 'Servise ID',
            'servise_title' => 'Servise Title',
            'servise_long_title' => 'Servise Long Title',
            'servise_description' => 'Servise Description',
            'introtext' => 'Introtext',
            'alias' => 'Alias',
            'menu_title' => 'Menu Title',
            'content' => 'Content',
            'head_text' => 'Head Text',
            'service_to_price_list' => 'Service To Price List',
            'price_to_service' => 'Price To Service',
            'medic_to_service' => 'Medic To Service',
            'review_to_service' => 'Review To Service',
            'query_to_service' => 'Query To Service',
            'padej_predl' => 'Padej Predl',
            'keywords' => 'Keywords',
            'price_title' => 'Price Title',
            'review_title' => 'Review Title',
            'faq_title' => 'Faq Title',
            'medic_title' => 'Medic Title',
            'parent_id' => 'Parent ID',
            'old_id' => 'Old ID',
        ];
    }
}
