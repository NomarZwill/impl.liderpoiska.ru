<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "doctors_page_sort".
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $page_id
 * @property string $page_type
 * @property int $sort_index
 */
class DoctorsPageSort extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctors_page_sort';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'page_id', 'page_type', 'sort_index'], 'required'],
            [['doctor_id', 'page_id', 'sort_index'], 'integer'],
            [['page_type'], 'string'],
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
            'page_id' => 'Page ID',
            'page_type' => 'Page Type',
            'sort_index' => 'Sort Index',
        ];
    }

    public function getDoctors()
    {
        return $this->hasMany(Doctors::className(), ['doctor_id' => 'doctor_id'])
            ->where(['doctors.is_active' => 1])
            ->joinWith('medicalSpecialties');
    }

    public function getServises()
    {
        return $this->hasMany(Servises::className(), ['servise_id' => 'page_id']);
    }

    public function getClinics()
    {
        return $this->hasMany(Clinics::className(), ['clinic_id' => 'page_id'])
        ->joinWith('ratings')
        ->joinWith('reviews')
        ->joinWith('imageGalleries');
    }
}
