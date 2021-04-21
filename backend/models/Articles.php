<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use \common\html_constructor\models\HcDraft;
use \common\components\Transliteration;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $h1_title
 * @property string $alias
 * @property int $is_active
 * @property int $sort
 * @property string $head_text
 * @property string $article_rating
 * @property int $article_votes
 * @property int $article_hc_draft_id
 */
class Articles extends \yii\db\ActiveRecord
{
    public $preview_image_load;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'keywords', 'h1_title', 'alias', 'head_text', 'preview_image'], 'string'],
            [['is_active', 'sort', 'page_votes', 'article_hc_draft_id'], 'integer'],
            [['page_rating'], 'number'],
            [['publishing_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'h1_title' => 'Заголовок h1',
            'alias' => 'Alias',
            'is_active' => 'Активен',
            'sort' => 'Позиция в листинге',
            'head_text' => 'Интро текст',
            'page_rating' => 'Article Rating',
            'page_votes' => 'Article Votes',
            'article_hc_draft_id' => 'Article Hc Draft ID',
            'publishing_date' => 'Дата публикации (гггг-мм-дд)',
            'preview_image' => 'Изображение для листинга',
            'preview_image_load' => 'Изображение для листинга',
        ];
    }

    public function getMicroData($article){

        $finalJSON = Html::script(
            Json::encode([
                "@context" => "https://schema.org/",
                "@type" => "MedicalWebPage",
                "url" => "https://www.impl.ru/articles/" . $article->alias . "/",
                "description" => $article->description,
                "headline" => $article->h1_title,
                "editor" => [
                    "@type" => "Person",
                    "name" => "Климович Виктория Борисовна, Квалифицированный специалист в области ортодонтии",
                ],
                "publisher" => [
                    "@type" => "Organization",
                    "name" => "Центр Стоматологической Имплантологии",
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


    public function getSeo(){
        return $seo = [
            'title' => $this->title,
            'desc' => $this->description,
            'kw' => $this->keywords,
        ];
    }

    public function getArrayToSelect2() {
        $array = [];
        $articles = Articles::find()->all();

        foreach ($articles as $article) {
            $array[$article->id] = $article->h1_title;
        }

        return $array;
    }

    public function getPrices() {
        $prices = $this->hasMany(Prices::className(), ['prices_id' => 'price_id'])
            ->viaTable('articles_prices_rel', ['article_id' => 'id']);

        return $prices;
    }

    public function getFaq() {
        $faq = $this->hasMany(Faq::className(), ['faq_id' => 'faq_id'])
            ->viaTable('articles_faq_rel', ['article_id' => 'id']);

        return $faq;
    }

    public function uploadImage()
    {
        if ($this->validate()) {

            if (!empty($this->preview_image_load)) {
                
                foreach ($this->preview_image_load as $file) {
                    $path = 'images/uploaded/articles/'. $this->id . '/';
                    FileHelper::createDirectory($path);
                    $file->saveAs($path . time() . '.' . $file->extension);
                    $this->preview_image = time() . '.' . $file->extension;
                }
            }

            return true;
        } else {
            return $this->validate();
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (empty($this->alias)) {
            $this->alias = Transliteration::getTransliteration($this->h1_title);
            $this->save();
        }

        if (empty($this->article_hc_draft_id)) {
            $model = new HcDraft;
            $model->name = $this->h1_title;
            $model->alias = $this->alias;
            $model->save();
            $this->article_hc_draft_id = $model->id;
            $this->save();
        }

        parent::afterSave($insert, $changedAttributes);
    }

}
