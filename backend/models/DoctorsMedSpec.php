<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "doctors_med_spec".
 *
 * @property int $doctor_id
 * @property int $specialty_id
 */
class DoctorsMedSpec extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctors_med_spec';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'specialty_id'], 'required'],
            [['doctor_id', 'specialty_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'doctor_id' => 'Doctor ID',
            'specialty_id' => 'Specialty ID',
        ];
    }

    public function getDoctorSpecialtyIDs($doctorID){
        $doctorSpecIDList = [];
        $doctorSpecList = DoctorsMedSpec::find()->where(['doctor_id' => $doctorID])->all();

        foreach ($doctorSpecList as $item) {
            $doctorSpecIDList[] = $item->specialty_id;
        }
        return $doctorSpecIDList;
            
    }
}
