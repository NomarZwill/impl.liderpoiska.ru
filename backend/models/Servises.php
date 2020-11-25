<?php

namespace backend\models;

use Yii;
use \common\html_constructor\models\HcDraft;
use \common\components\Transliteration;

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
 * @property string $image
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
 * @property string $service_page_rating
 * @property int $service_page_votes
 * @property int $index_id
 * @property int $servise_listing_id
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
            [['servise_title'], 'required'],
            [['servise_title', 'h1_title', 'header_menu_title', 'servise_long_title', 'servise_description', 'introtext', 'alias', 'menu_title', 'breadcrumbs_title', 'content', 'image', 'head_text', 'service_to_price_list', 'price_to_service', 'medic_to_service', 'review_to_service', 'query_to_service', 'padej_predl', 'keywords', 'price_title', 'review_title', 'faq_title', 'medic_title'], 'string'],
            [['service_page_rating'], 'number'],
            [['service_page_votes', 'index_id', 'is_active', 'is_visible_in_menu', 'servise_listing_sort', 'servise_parent_block_sort', 'servise_listing_id', 'servise_hc_draft_id', 'parent_id', 'old_id'], 'integer'],
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
            'h1_title' => 'Заголовок h1',
            'header_menu_title' => 'Заголовок услуги в меню в хедере',
            'servise_long_title' => 'Title',
            'servise_description' => 'Описание',
            'introtext' => 'Introtext',
            'breadcrumbs_title' => 'Название в хлебной крошке',
            'alias' => 'Alias',
            'is_active' => 'Активен',
            'is_visible_in_menu' => 'Выводить в меню',
            'menu_title' => 'Название для меню',
            'content' => 'Контент',
            'head_text' => 'Вводный текст',
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
            'image' => 'Image',
            'service_page_rating' => 'Service Page Rating',
            'service_page_votes' => 'Service Page Votes',
            'index_id' => 'Index ID',
            'servise_listing_id' => 'Servise Listing ID',
            'servise_hc_draft_id' => 'servise_hc_draft_id',
            'parent_id' => 'Родительская услуга',
            'old_id' => 'Old ID',
            'servise_listing_sort' => 'Позиция в листинге услуг',
            'servise_parent_block_sort' => 'Позиция на странице родительской услуги',
        ];
    }

    public function setFirstLevelChildCount(array &$allServices) {

        foreach ($allServices as $key => $service){
            if ($service['parent_id'] === '0') {
               $allServices[$key]['first_level_child_count'] = Servises::getFirstLevelChildCount($allServices, $service['servise_id']);
            }
         }
    }

    public function getFirstLevelChildCount(array $allServices, string $parentID) {
        $childCounter = 0;

        foreach ($allServices as $service) {
            if ($service['parent_id'] === $parentID) {
                $childCounter++;
            }
        }

        return $childCounter;
    }

    public function getPrices() {
        return $this->hasMany(Prices::className(), ['prices_id' => 'prices_id'])
            ->viaTable('service_and_prices', ['service_id' => 'servise_id']);
    }

    public function getReviews() {
        return $this->hasMany(Reviews::className(), ['review_id' => 'review_id'])
            ->viaTable('review_service_rel', ['service_id' => 'servise_id']);
    }

    public function getFaq() {
        return $this->hasMany(Faq::className(), ['faq_id' => 'faq_id'])
            ->viaTable('faq_services_rel', ['service_id' => 'servise_id']);
    }

    public function getArrayToSelect2() {
        $array = [];
        $servises = Servises::find()->all();

        foreach ($servises as $servise) {
            $array[$servise->servise_id] = $servise->menu_title;
        }

        return $array;
    }

    public function getServiceParentIDs($serviceID){
        $serviceParentIDList = [];
        $serviceParentList = Servises::find()->where(['servise_id' => $serviceID])->all();

        foreach ($serviceParentList as $item) {
            $serviceParentIDList[] = $item->parent_id;
        }
        return $serviceParentIDList;
    }

    public function getBreadcrumbs(array $parentServiceAliasArray){
        $breadcrumbs = [];
        $aliasTmp = '';
        foreach ($parentServiceAliasArray as $service) {
            $aliasTmp = $aliasTmp . $service . '/';
            $breadcrumbs[$aliasTmp] = Servises::find()
                ->where(['alias' => $service])
                ->one()
                ->header_menu_title;
        }
        return $breadcrumbs;
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        if (empty($this->alias)) {
            $this->alias = Transliteration::getTransliteration($this->servise_title);
            $this->save();
        }
        
        if (empty($this->servise_hc_draft_id)) {
            $model = new HcDraft;
            $model->name = $this->servise_title;
            $model->alias = $this->alias;
            $model->save();
            $this->servise_hc_draft_id = $model->id;
            $this->save();
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
