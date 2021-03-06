<?php

namespace backend\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
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
 * @property string $page_rating
 * @property int $page_votes
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
            [['page_rating'], 'number'],
            [['page_votes', 'index_id', 'is_active', 'is_visible_in_menu', 'servise_listing_sort', 'servise_parent_block_sort', 'servise_listing_id', 'servise_hc_draft_id', 'parent_id', 'old_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'servise_id' => 'ID',
            'servise_title' => '????????????????',
            'h1_title' => '?????????????????? h1',
            'header_menu_title' => '?????????????????? ???????????? ?? ???????? ?? ????????????',
            'servise_long_title' => 'Title',
            'servise_description' => '????????????????',
            'introtext' => 'Introtext',
            'breadcrumbs_title' => '???????????????? ?? ?????????????? ????????????',
            'alias' => 'Alias',
            'is_active' => '??????????????',
            'is_visible_in_menu' => '???????????????? ?? ????????',
            'menu_title' => '???????????????? ?????? ????????',
            'content' => '??????????????',
            'head_text' => '?????????????? ??????????',
            'service_to_price_list' => 'Service To Price List',
            'price_to_service' => 'Price To Service',
            'medic_to_service' => 'Medic To Service',
            'review_to_service' => 'Review To Service',
            'query_to_service' => 'Query To Service',
            'padej_predl' => '???????????????????? ??????????',
            'keywords' => '???????????????? ??????????',
            'price_title' => '???????????????? ?????? ????????',
            'review_title' => '???????????????? ?????? ????????????',
            'faq_title' => '???????????????? ?????? FAQ',
            'medic_title' => '???????????????? ?????? ??????????',
            'image' => 'Image',
            'page_rating' => 'Service Page Rating',
            'page_votes' => 'Service Page Votes',
            'index_id' => 'Index ID',
            'servise_listing_id' => 'Servise Listing ID',
            'servise_hc_draft_id' => 'servise_hc_draft_id',
            'parent_id' => '???????????????????????? ????????????',
            'old_id' => 'Old ID',
            'servise_listing_sort' => '?????????????? ?? ???????????????? ??????????',
            'servise_parent_block_sort' => '?????????????? ???? ???????????????? ???????????????????????? ????????????',
        ];
    }

    public function getMicroData($service, $url){

        $finalJSON = Html::script(
            Json::encode([
                "@context" => "https://schema.org/",
                "@type" => "MedicalWebPage",
                "url" => "https://www.impl.ru" . $url,
                "description" => $service->servise_description,
                "headline" => $service->h1_title,
                "editor" => [
                    "@type" => "Person",
                    "name" => "???????????????? ???????????????? ??????????????????, ?????????????????????????????????? ???????????????????? ?? ?????????????? ????????????????????",
                ],
                "publisher" => [
                    "@type" => "Organization",
                    "name" => "?????????? ?????????????????????????????????? ??????????????????????????",
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => "https://www.impl.ru/img/impl-logo.svg",
                        ]
                ]
            ]), [
            'type' => 'application/ld+json',
        ]);

        return $finalJSON;
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

    public function getSeo(){
        return $seo = [
            'title' => $this->servise_long_title,
            'desc' => $this->servise_description,
            'kw' => $this->keywords,
        ];
    }

    public function getPrices() {
        return $this->hasMany(Prices::className(), ['prices_id' => 'prices_id'])
            ->viaTable('service_and_prices', ['service_id' => 'servise_id']);
    }

    public function getReviews() {
        $reviews = $this->hasMany(Reviews::className(), ['review_id' => 'review_id'])
            ->viaTable('review_service_rel', ['service_id' => 'servise_id'])
            ->where(['reviews.is_active' => 1])
            ->orderBy(['reviews.date' => SORT_DESC]);

        return $reviews;
    }

    public function getFaq() {
        $faq = $this->hasMany(Faq::className(), ['faq_id' => 'faq_id'])
            ->viaTable('faq_services_rel', ['service_id' => 'servise_id']);

        return $faq;
    }

    public function getArrayToSelect2() {
        $array = [];
        $servises = Servises::find()->all();

        foreach ($servises as $servise) {
            $array[$servise->servise_id] = $servise->header_menu_title;
        }

        return $array;
    }

    public function getServicesRootsArrayToSelect2() {
        $array = [];
        $servises = Servises::find()
            ->where(['parent_id' => 0])
            ->all();

        foreach ($servises as $servise) {
            $array[$servise->servise_id] = $servise->header_menu_title;
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

    public function getCurrentService($currentService, $serviceParentAlias){

        foreach ($currentService as $service){

            $parent = Servises::find()
            ->where(['servise_id' => $service->parent_id])
            ->all();

            if (count($parent) === 1 && $parent[0]->alias === $serviceParentAlias) {
                return $service;
            } 
        }

        return false;
    }

    public function getBunnersForRootServices(){
        $bunners =  $this->hasMany(Banners::className(), ['id' => 'banner_id'])
            ->viaTable('banners_and_services', ['service_id' => 'servise_id'])
            ->where(['banners.is_active' => 1]);

        return $bunners;
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
