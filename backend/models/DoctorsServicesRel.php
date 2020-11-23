<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "doctors_services_rel".
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $service_id
 */
class DoctorsServicesRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctors_services_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'service_id'], 'required'],
            [['doctor_id', 'service_id'], 'integer'],
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
            'service_id' => 'Service ID',
        ];
    }

    public function getDoctorServiceIDs($doctorID){
        $doctorServiceIDList = [];
        $doctorServiceList = DoctorsServicesRel::find()->where(['doctor_id' => $doctorID])->all();

        foreach ($doctorServiceList as $item) {
            $doctorServiceIDList[] = $item->service_id;
        }
        return $doctorServiceIDList;
            
    }
}
