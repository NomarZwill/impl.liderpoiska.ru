<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "prices".
 *
 * @property int $prices_id
 * @property string $prices_name
 * @property int $price
 * @property string $price_hide
 * @property string $keywords
 * @property string $code
 * @property string $alias
 * @property string $link
 * @property string $text_1
 * @property int $old_id
 */
class Prices extends \yii\db\ActiveRecord
{

    public $price_services_rel;
    public $price_articles_rel;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prices_name', 'price'], 'required'],
            [['prices_name', 'keywords', 'prices_description', 'code', 'alias', 'link', 'text_1'], 'string'],
            [['price', 'price_hide', 'is_active', 'old_id'], 'integer'],
            [['price_services_rel', 'price_articles_rel'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'prices_id' => 'ID',
            'prices_name' => 'Название услуги',
            'price' => 'Стоимость',
            'price_hide' => 'Стоимость со скидкой',
            'keywords' => 'Ключевые слова',
            'prices_description' => 'Описание',
            'is_active' => 'Активен',
            'code' => 'Код',
            'alias' => 'Alias',
            'price_services_rel' => 'Выбор услуг',
            'price_articles_rel' => 'Выбор статей',
            'link' => 'Ссылка на услугу',
            'text_1' => 'Текст под строкой',
            'old_id' => 'Old ID',
        ];
    }

    public function updateArticleRelations(){

        if (!empty($this->price_articles_rel)) {
    
            foreach (ArticlesPricesRel::find()->where(['price_id' => $this->prices_id])->all() as $item) {
                if (array_search($item->article_id, $this->price_articles_rel) === false) {
                    $item->delete();
                }
            }
            
            foreach ($this->price_articles_rel as $article) {
                $priceArticle = new ArticlesPricesRel();
                $priceArticle->price_id = $this->prices_id;
                $priceArticle->article_id = $article;
                if (!ArticlesPricesRel::find()->where(['price_id' => $this->prices_id, 'article_id' => $article])->exists()) {
                    $priceArticle->save();
                }
            }
        } else {
            
            foreach (ArticlesPricesRel::find()->where(['price_id' => $this->prices_id])->all() as $item) {
                $item->delete();
            }
        }
    }

    public function afterSave($insert, $changedAttributes){

        if (!empty($this->price_services_rel)) {

            // удаление стёртых значений
            foreach (ServiceAndPrices::find()->where(['prices_id' => $this->prices_id])->all() as $item) {
                if (array_search($item->service_id, $this->price_services_rel) === false) {
                    $item->delete();
                    // echo $item->service_id . ' deleted, ';
                }
            }
            
            // добавление вновь выбранных значений
            foreach ($this->price_services_rel as $service) {
                $priceService = new ServiceAndPrices();
                $priceService->prices_id = $this->prices_id;
                $priceService->service_id = $service;
                if (!ServiceAndPrices::find()->where(['prices_id' => $this->prices_id, 'service_id' => $service])->exists()) {
                    $priceService->save();
                    // echo $priceService->service_id . ' saved, ';
                }
            }
        } else {
            
            foreach (ServiceAndPrices::find()->where(['prices_id' => $this->prices_id])->all() as $item) {
                $item->delete();
                // echo $item->service_id . ' deleted, ';
            }
        }

        $this->updateArticleRelations();

        parent::afterSave($insert, $changedAttributes);
    }
}
