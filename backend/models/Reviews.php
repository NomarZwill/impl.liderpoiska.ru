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
            'review_id' => 'ID',
            'author' => 'Автор',
            'date' => 'Дата',
            'review_text' => 'Текст отзыва',
            'review_title' => 'Заголовок',
        ];
    }

    public function getYearsList(){
        $yearsSet = [];
        $reviews = Reviews::find()->all();
        foreach ($reviews as $review){
            if (array_search(substr($review->date, 0, 4), $yearsSet) === false) {
                array_push($yearsSet, substr($review->date, 0, 4));
            }
        }
        rsort($yearsSet);
        return $yearsSet;
    }

    // public function getSingleYearReviews($reviews, $year){
    //     $yearsSet = [];
    //     foreach ($reviews as $review){
    //         if (substr($review->date, 0, 4) === $year){
    //             array_push($yearsSet, $review);
    //         }
    //     }
    //     return $yearsSet;
    // }
}
