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
            'servise_id' => 'ID',
            'servise_title' => 'Название',
            'servise_long_title' => 'Длинное название',
            'servise_description' => 'Описание',
            'introtext' => 'Introtext',
            'alias' => 'Alias',
            'menu_title' => 'Название для меню',
            'content' => 'Контент',
            'head_text' => 'Head Text',
            'service_to_price_list' => 'Service To Price List',
            'price_to_service' => 'Price To Service',
            'medic_to_service' => 'Medic To Service',
            'review_to_service' => 'Review To Service',
            'query_to_service' => 'Query To Service',
            'padej_predl' => 'Предложный падеж',
            'keywords' => 'Ключевые слова',
            'price_title' => 'Название для цены',
            'review_title' => 'Название для отзыва',
            'faq_title' => 'Название для FAQ',
            'medic_title' => 'Название для врача',
            'parent_id' => 'Parent ID',
            'old_id' => 'Old ID',
        ];
    }

    public function setFirstLevelChildCount(array &$allServices){

        foreach ($allServices as $key => $service){
            if ($service['parent_id'] === '0') {
               $allServices[$key]['first_level_child_count'] = Servises::getFirstLevelChildCount($allServices, $service['old_id']);
            }
         }
    }

    public function getFirstLevelChildCount(array $allServices, string $parentOldID){
        $childCounter = 0;

        foreach ($allServices as $service) {
            if ($service['parent_id'] === $parentOldID) {
                $childCounter++;
            }
        }

        return $childCounter;
    }

    public function getPrices(){
        return $this->hasMany(Prices::className(), ['prices_id' => 'prices_id'])
            ->viaTable('service_and_prices', ['service_id' => 'servise_id']);
    }


}
