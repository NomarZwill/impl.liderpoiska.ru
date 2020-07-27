<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $review_id
 * @property string $author
 * @property string $date
 * @property string $review_text
 * @property string $review_title
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author', 'date', 'review_text', 'review_title'], 'required'],
            [['date'], 'safe'],
            [['review_text', 'review_title'], 'string'],
            [['author'], 'string', 'max' => 50],
            [['old_id'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'review_id' => 'Review ID',
            'author' => 'Author',
            'date' => 'Date',
            'review_text' => 'Review Text',
            'review_title' => 'Review Title',
        ];
    }
}