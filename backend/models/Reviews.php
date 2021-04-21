<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $review_id
 * @property string $author
 * @property string $date
 * @property string $review_text
 * @property string $review_title
 */
class Reviews extends \yii\db\ActiveRecord
{

    public $review_service_rel;
    public $review_spec_rel;
    public $review_doctor_rel;
    public $review_clinic_rel;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author', 'date', 'review_text', 'author_age'], 'required'],
            [['date', 'review_service_rel', 'review_spec_rel', 'review_doctor_rel', 'review_clinic_rel'], 'safe'],
            [['review_text', 'review_title'], 'string'],
            [['author', 'year'], 'string', 'max' => 50],
            [['old_id', 'doctor_id', 'author_age', 'is_active'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'review_id' => 'ID',
            'author' => 'Автор',
            'author_age' => 'Возраст автора',
            'date' => 'Дата (гггг-мм-дд)',
            'review_text' => 'Текст отзыва',
            'review_title' => 'Заголовок',
            'doctor_id' => 'Врач',
            'is_active' => 'Активен',
            'review_service_rel' => 'Отношение отзыва к услугам',
            'review_spec_rel' => 'Отношение отзыва к специальностям',
            'review_doctor_rel' => 'Отношение отзыва к врачам',
            'review_clinic_rel' => 'Отношение отзыва к клиникам',

        ];
    }

    public function getYearsList(){
        $yearsSet = [];
        $reviews = Reviews::find()->all();
        foreach ($reviews as $review){
            if (array_search(substr($review->date, 0, 4), $yearsSet) === false) {
                array_push($yearsSet, substr($review->date, 0, 4));
            }
        }
        rsort($yearsSet);
        return $yearsSet;
    }

    public function afterSave($insert, $changedAttributes){

        if ($this->year !== substr($this->date, 0, 4)){
            $this->year = substr($this->date, 0, 4);
            $this->save();
        }

        if (!empty($this->review_service_rel)) {

            // удаление стёртых значений из таблицы отзыв-услуга
            foreach (ReviewServiceRel::find()->where(['review_id' => $this->review_id])->all() as $item) {
                if (array_search($item->service_id, $this->review_service_rel) === false) {
                    $item->delete();
                    // echo $item->service_id . ' deleted, ';
                }
            }
            
            // добавление вновь выбранных значений
            foreach ($this->review_service_rel as $service) {
                $reviewService = new ReviewServiceRel();
                $reviewService->review_id = $this->review_id;
                $reviewService->service_id = $service;
                if (!ReviewServiceRel::find()->where(['review_id' => $this->review_id, 'service_id' => $service])->exists()) {
                    $reviewService->save();
                    // echo $reviewService->service_id . ' saved, ';
                }
            }
        } else {
            
            foreach (ReviewServiceRel::find()->where(['review_id' => $this->review_id])->all() as $item) {
                $item->delete();
                // echo $item->service_id . ' deleted, ';
            }
        }

        if (!empty($this->review_spec_rel)) {

            // удаление стёртых значений из таблицы отзыв-специальность
            foreach (ReviewSpecRel::find()->where(['review_id' => $this->review_id])->all() as $item) {
                if (array_search($item->specialty_id, $this->review_spec_rel) === false) {
                    $item->delete();
                }
            }

            // добавление вновь выбранных значений
            foreach ($this->review_spec_rel as $spec) {
                $reviewSpec = new ReviewSpecRel();
                $reviewSpec->review_id = $this->review_id;
                $reviewSpec->specialty_id = $spec;
                if (!ReviewSpecRel::find()->where(['review_id' => $this->review_id, 'specialty_id' => $spec])->exists()) {
                    $reviewSpec->save();
                    // echo $reviewSpec->specialty_id . ' saved, ';
                }
            }
        } else {
            
            foreach (ReviewSpecRel::find()->where(['review_id' => $this->review_id])->all() as $item) {
                $item->delete();
                // echo $item->service_id . ' deleted, ';
            }
        }

        if (!empty($this->review_doctor_rel)) {

            // удаление стёртых значений из таблицы отзыв-доктор
            foreach (ReviewDoctorsRel::find()->where(['review_id' => $this->review_id])->all() as $item) {
                if (array_search($item->doctor_id, $this->review_doctor_rel) === false) {
                    $item->delete();
                }
            }

            // добавление вновь выбранных значений
            foreach ($this->review_doctor_rel as $doc) {
                $reviewDoc = new ReviewDoctorsRel();
                $reviewDoc->review_id = $this->review_id;
                $reviewDoc->doctor_id = $doc;
                if (!ReviewDoctorsRel::find()->where(['review_id' => $this->review_id, 'doctor_id' => $doc])->exists()) {
                    $reviewDoc->save();
                    // echo $reviewDoc->specialty_id . ' saved, ';
                }
            }
        } else {
            
            foreach (ReviewDoctorsRel::find()->where(['review_id' => $this->review_id])->all() as $item) {
                $item->delete();
                // echo $item->service_id . ' deleted, ';
            }
        }
        
        if (!empty($this->review_clinic_rel)) {

            // удаление стёртых значений из таблицы отзыв-клиника
            foreach (ReviewClinicRel::find()->where(['review_id' => $this->review_id])->all() as $item) {
                if (array_search($item->clinic_id, $this->review_clinic_rel) === false) {
                    $item->delete();
                }
            }

            // добавление вновь выбранных значений
            foreach ($this->review_clinic_rel as $clinic) {
                $reviewClinic = new ReviewClinicRel();
                $reviewClinic->review_id = $this->review_id;
                $reviewClinic->clinic_id = $clinic;
                if (!ReviewClinicRel::find()->where(['review_id' => $this->review_id, 'clinic_id' => $clinic])->exists()) {
                    $reviewClinic->save();
                    // echo $reviewClinic->specialty_id . ' saved, ';
                }
            }
        } else {
            
            foreach (ReviewClinicRel::find()->where(['review_id' => $this->review_id])->all() as $item) {
                $item->delete();
                // echo $item->service_id . ' deleted, ';
            }
        }

        // print_r($this->review_clinic_rel);
        // exit;

        parent::afterSave($insert, $changedAttributes);
    }

    // public function getSingleYearReviews($reviews, $year){
    //     $yearsSet = [];
    //     foreach ($reviews as $review){
    //         if (substr($review->date, 0, 4) === $year){
    //             array_push($yearsSet, $review);
    //         }
    //     }
    //     return $yearsSet;
    // }
}
