<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "medical_specialties".
 *
 * @property int $specialty_id
 * @property string $specialty_title
 * @property string $specialty_long_title
 * @property string $specialty_description
 * @property string $introtext
 * @property string $alias
 * @property string $menu_title
 * @property string $content
 * @property string $speciality_review
 * @property string $head_text
 * @property string $price_title
 * @property string $review_title
 * @property string $faq_title
 * @property string $medic_to_special
 * @property string $query_to_service
 * @property string $price_to_service
 * @property string $keywords
 * @property int $old_id
 */
class MedicalSpecialties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medical_specialties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['specialty_title', 'specialty_long_title', 'specialty_description', 'introtext', 'alias', 'menu_title', 'content', 'speciality_review', 'head_text', 'price_title', 'review_title', 'faq_title', 'medic_to_special', 'query_to_service', 'price_to_service', 'keywords'], 'string'],
            [['old_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'specialty_id' => 'Specialty ID',
            'specialty_title' => 'Specialty Title',
            'specialty_long_title' => 'Specialty Long Title',
            'specialty_description' => 'Specialty Description',
            'introtext' => 'Introtext',
            'alias' => 'Alias',
            'menu_title' => 'Menu Title',
            'content' => 'Content',
            'speciality_review' => 'Speciality Review',
            'head_text' => 'Head Text',
            'price_title' => 'Price Title',
            'review_title' => 'Review Title',
            'faq_title' => 'Faq Title',
            'medic_to_special' => 'Medic To Special',
            'query_to_service' => 'Query To Service',
            'price_to_service' => 'Price To Service',
            'keywords' => 'Keywords',
            'old_id' => 'Old ID',
        ];
    }

    public function getDoctors(){
        return $this->hasMany(Doctors::className(), ['doctor_id' => 'doctor_id'])
            ->viaTable('doctors_med_spec', ['specialty_id' => 'specialty_id']);
    }
}
