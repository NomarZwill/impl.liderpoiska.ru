<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "doctors_and_clinics".
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $clinic_id
 */
class DoctorsAndClinics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctors_and_clinics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'clinic_id'], 'required'],
            [['doctor_id', 'clinic_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_id' => 'Doctor ID',
            'clinic_id' => 'Clinic ID',
        ];
    }
}
