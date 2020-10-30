<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "doctors_hc_draft".
 *
 * @property int $doctor_id
 * @property int $hc_draft_id
 */
class DoctorsHcDraft extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctors_hc_draft';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'hc_draft_id'], 'required'],
            [['doctor_id', 'hc_draft_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'doctor_id' => 'Doctor ID',
            'hc_draft_id' => 'Hc Draft ID',
        ];
    }
}
