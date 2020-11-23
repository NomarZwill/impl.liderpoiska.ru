<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "review_doctors_rel".
 *
 * @property int $id
 * @property int $review_id
 * @property int $doctor_id
 */
class ReviewDoctorsRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review_doctors_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['review_id', 'doctor_id'], 'required'],
            [['review_id', 'doctor_id'], 'integer'],
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
            'doctor_id' => 'Doctor ID',
        ];
    }

    public function getReviewDoctorIDs($reviewID){
        $reviewDoctorIDList = [];
        $reviewDoctorList = ReviewDoctorsRel::find()->where(['review_id' => $reviewID])->all();

        foreach ($reviewDoctorList as $item) {
            $reviewDoctorIDList[] = $item->doctor_id;
        }
        return $reviewDoctorIDList;
    }
}
