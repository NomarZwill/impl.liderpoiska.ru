<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "review_spec_rel".
 *
 * @property int $id
 * @property int $review_id
 * @property int $speciality_id
 */
class ReviewSpecRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review_spec_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['review_id', 'specialty_id'], 'required'],
            [['review_id', 'specialty_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'review_id' => 'Review ID',
            'specialty_id' => 'Specialty ID',
        ];
    }

    public function getReviewSpecIDs($reviewID){
        $reviewSpecIDList = [];
        $reviewSpecList = ReviewSpecRel::find()->where(['review_id' => $reviewID])->all();

        foreach ($reviewSpecList as $item) {
            $reviewSpecIDList[] = $item->specialty_id;
        }
        return $reviewSpecIDList;
    }
}
