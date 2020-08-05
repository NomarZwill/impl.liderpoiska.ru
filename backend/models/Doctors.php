<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "doctors".
 *
 * @property int $doctor_id
 * @property string $doctor_title
 * @property string $doctor_long_title
 * @property string $doctor_description
 * @property string $introtext
 * @property string $alias
 * @property string $content
 * @property string $doctor_education
 * @property string $doctor_image
 * @property string $medic_to_filial
 * @property string $sort_lab_smail
 * @property string $sort_doyche_velle
 * @property string $sort_esteticheskaya_stomatologiya_chistie_prudi
 * @property string $sort_esteticheskaya_stomatologiya
 * @property string $sort_impl
 * @property string $sort_centr_implantologii
 * @property string $review_to_specials
 * @property string $specials_to_medic
 * @property string $review_title
 * @property string $query_to_service
 * @property string $faq_title
 * @property string $sort_klinika_dentalgeneva
 * @property string $sort_prec_1005
 * @property string $sort_prec_1154
 * @property string $sort_prec_1459
 * @property string $sort_prec_988
 * @property string $sort_prec_989
 * @property string $sort_prec_990
 * @property string $sort_prec_991
 * @property string $sort_prec_992
 * @property string $sort_prec_994
 * @property int $old_id
 */
class Doctors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_title', 'doctor_long_title', 'doctor_description', 'alias', 'content', 'doctor_education', 'doctor_image', 'old_id'], 'required'],
            [['doctor_title', 'doctor_long_title', 'doctor_description', 'introtext', 'alias', 'content', 'doctor_education', 'doctor_image', 'medic_to_filial', 'sort_lab_smail', 'sort_doyche_velle', 'sort_esteticheskaya_stomatologiya_chistie_prudi', 'sort_esteticheskaya_stomatologiya', 'sort_impl', 'sort_centr_implantologii', 'review_to_specials', 'specials_to_medic', 'review_title', 'query_to_service', 'faq_title', 'sort_klinika_dentalgeneva', 'sort_prec_1005', 'sort_prec_1154', 'sort_prec_1459', 'sort_prec_988', 'sort_prec_989', 'sort_prec_990', 'sort_prec_991', 'sort_prec_992', 'sort_prec_994'], 'string'],
            [['old_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'doctor_id' => 'Doctor ID',
            'doctor_title' => 'Doctor Title',
            'doctor_long_title' => 'Doctor Long Title',
            'doctor_description' => 'Doctor Description',
            'introtext' => 'Introtext',
            'alias' => 'Alias',
            'content' => 'Content',
            'doctor_education' => 'Doctor Education',
            'doctor_image' => 'Doctor Image',
            'medic_to_filial' => 'Medic To Filial',
            'sort_lab_smail' => 'Sort Lab Smail',
            'sort_doyche_velle' => 'Sort Doyche Velle',
            'sort_esteticheskaya_stomatologiya_chistie_prudi' => 'Sort Esteticheskaya Stomatologiya Chistie Prudi',
            'sort_esteticheskaya_stomatologiya' => 'Sort Esteticheskaya Stomatologiya',
            'sort_impl' => 'Sort Impl',
            'sort_centr_implantologii' => 'Sort Centr Implantologii',
            'review_to_specials' => 'Review To Specials',
            'specials_to_medic' => 'Specials To Medic',
            'review_title' => 'Review Title',
            'query_to_service' => 'Query To Service',
            'faq_title' => 'Faq Title',
            'sort_klinika_dentalgeneva' => 'Sort Klinika Dentalgeneva',
            'sort_prec_1005' => 'Sort Prec 1005',
            'sort_prec_1154' => 'Sort Prec 1154',
            'sort_prec_1459' => 'Sort Prec 1459',
            'sort_prec_988' => 'Sort Prec 988',
            'sort_prec_989' => 'Sort Prec 989',
            'sort_prec_990' => 'Sort Prec 990',
            'sort_prec_991' => 'Sort Prec 991',
            'sort_prec_992' => 'Sort Prec 992',
            'sort_prec_994' => 'Sort Prec 994',
            'old_id' => 'Old ID',
        ];
    }

    public function getMedSpec(){
        return $this->hasMany(MedicalSpecialties::className(), ['specialty_id' => 'specialty_id'])
            ->viaTable('doctors_med_spec', ['doctor_id' => 'doctor_id']);
    }
}
