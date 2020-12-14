<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "articles_prices_rel".
 *
 * @property int $id
 * @property int $article_id
 * @property int $price_id
 */
class ArticlesPricesRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles_prices_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'price_id'], 'required'],
            [['article_id', 'price_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'price_id' => 'Price ID',
        ];
    }

    public function getPriceArticleIDs($pricesID){
        $priceArticleIDList = [];
        $priceArticleList = ArticlesPricesRel::find()->where(['price_id' => $pricesID])->all();

        foreach ($priceArticleList as $item) {
            $priceArticleIDList[] = $item->article_id;
        }
        return $priceArticleIDList;
            
    }
}
