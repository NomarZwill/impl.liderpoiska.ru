<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "review_clinic_rel".
 *
 * @property int $id
 * @property int $review_id
 * @property int $clinic_id
 */
class ReviewClinicRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review_clinic_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['review_id', 'clinic_id'], 'required'],
            [['review_id', 'clinic_id'], 'integer'],
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
            'clinic_id' => 'Clinic ID',
        ];
    }

    public function getReviewClinicsIDs($reviewID){
        $reviewClinicIDList = [];
        $reviewClinicList = ReviewClinicRel::find()->where(['review_id' => $reviewID])->all();

        foreach ($reviewClinicList as $item) {
            $reviewClinicIDList[] = $item->clinic_id;
        }
        return $reviewClinicIDList;
    }
}
