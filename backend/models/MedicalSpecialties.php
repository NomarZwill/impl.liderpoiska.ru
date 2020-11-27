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
            [['specialty_title', 'h1_title', 'specialty_long_title', 'specialty_description', 'breadcrumbs_title', 'introtext', 'alias', 'menu_title', 'content', 'speciality_review', 'head_text', 'price_title', 'review_title', 'faq_title', 'medic_to_special', 'query_to_service', 'price_to_service', 'keywords', 'spec_title_second', 'first_content_block', 'second_content_block', 'third_content_block', 'last_content_block'], 'string'],
            [['old_id', 'specialty_sort', 'is_active'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'specialty_id' => 'ID',
            'specialty_title' => 'Название',
            'h1_title' => 'Заголовок h1',
            'specialty_long_title' => 'Title',
            'specialty_description' => 'Описание',
            'breadcrumbs_title' => 'Название в хлебной крошке',
            'introtext' => 'Вводный текст',
            'alias' => 'Alias',
            'is_active' => 'Активен',
            'menu_title' => 'Короткое название для селекторов и карточек врачей',
            'content' => 'Content',
            'speciality_review' => 'Speciality Review',
            'head_text' => 'Текст под заголовком',
            'first_content_block' => 'Текстовый блок повышенного внимания',
            'second_content_block' => 'Текстовый блок 2',
            'third_content_block' => 'Текстовый блок 3',
            'last_content_block' => 'Текстовый блок 4 (после формы обратной связи)',
            'price_title' => 'Price Title',
            'review_title' => 'Заголовок для отзывов',
            'faq_title' => 'Faq Title',
            'spec_title_second' => 'Заголовок для листинга специалистов',
            'medic_to_special' => 'Medic To Special',
            'query_to_service' => 'Query To Service',
            'price_to_service' => 'Price To Service',
            'keywords' => 'Ключевые слова',
            'specialty_sort' => 'Сортировка на страницах специальностей',
            'old_id' => 'Old ID',
        ];
    }

    public function getSeo(){
        return $seo = [
            'title' => $this->specialty_long_title,
            'desc' => $this->specialty_description,
            'kw' => $this->keywords,
        ];
    }

    public function getDoctors(){
        return $this->hasMany(Doctors::className(), ['doctor_id' => 'doctor_id'])
            ->viaTable('doctors_med_spec', ['specialty_id' => 'specialty_id']);
    }

    public function getReviews(){
        return $this->hasMany(Reviews::className(), ['review_id' => 'review_id'])
            ->viaTable('review_spec_rel', ['specialty_id' => 'specialty_id']);
    }

    public function getArrayToSelect2() {
        $array = [];
        $specs = MedicalSpecialties::find()->all();

        foreach ($specs as $spec) {
            $array[$spec->specialty_id] = $spec->specialty_title;
        }

        return $array;
    }
}
