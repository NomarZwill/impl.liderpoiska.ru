<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "review_service_rel".
 *
 * @property int $id
 * @property int $service_id
 * @property int $review_id
 */
class ReviewServiceRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review_service_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'review_id'], 'required'],
            [['service_id', 'review_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'review_id' => 'Review ID',
        ];
    }

    public function getReviewServiceIDs($reviewID){
        $reviewServiceIDList = [];
        $reviewServiceList = ReviewServiceRel::find()->where(['review_id' => $reviewID])->all();

        foreach ($reviewServiceList as $item) {
            $reviewServiceIDList[] = $item->service_id;
        }
        return $reviewServiceIDList;
    }
}
