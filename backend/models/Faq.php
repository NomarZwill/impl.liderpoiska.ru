<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "faq".
 *
 * @property int $faq_id
 * @property string $faq_title
 * @property string $faq_query
 * @property string $keywords
 * @property string $faq_answer
 * @property string $alias
 * @property int $old_id
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faq_title', 'faq_query', 'faq_answer', 'alias', 'old_id'], 'required'],
            [['faq_title', 'faq_query', 'keywords', 'faq_answer', 'alias'], 'string'],
            [['old_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'faq_id' => 'ID',
            'faq_title' => 'Заголовок',
            'faq_query' => 'Вопрос',
            'keywords' => 'Ключевые слова',
            'faq_answer' => 'Ответ',
            'alias' => 'Alias',
            'old_id' => 'Old ID',
        ];
    }
}
