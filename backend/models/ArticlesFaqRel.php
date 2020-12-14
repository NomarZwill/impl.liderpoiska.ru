<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "articles_faq_rel".
 *
 * @property int $id
 * @property int $article_id
 * @property int $faq_id
 */
class ArticlesFaqRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles_faq_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'faq_id'], 'required'],
            [['article_id', 'faq_id'], 'integer'],
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
            'faq_id' => 'Faq ID',
        ];
    }

    public function getFAQArticleIDs($faqID){
        $faqArticleIDList = [];
        $faqArticleList = ArticlesFaqRel::find()->where(['faq_id' => $faqID])->all();

        foreach ($faqArticleList as $item) {
            $faqArticleIDList[] = $item->article_id;
        }
        return $faqArticleIDList;
            
    }
}
