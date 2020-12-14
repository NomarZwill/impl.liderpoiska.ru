<?php

namespace backend\models;

use Yii;
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
            [['title', 'description', 'keywords', 'h1_title', 'alias', 'head_text'], 'string'],
            [['is_active', 'sort', 'article_votes', 'article_hc_draft_id'], 'integer'],
            [['article_rating'], 'number'],
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
            'article_rating' => 'Article Rating',
            'article_votes' => 'Article Votes',
            'article_hc_draft_id' => 'Article Hc Draft ID',
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
