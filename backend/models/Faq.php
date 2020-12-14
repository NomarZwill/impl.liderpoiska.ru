<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "faq".
 *
 * @property int $faq_id
 * @property string $faq_title
 * @property string $faq_query
 * @property string $keywords
 * @property string $faq_answer
 * @property string $alias
 * @property int $old_id
 */
class Faq extends \yii\db\ActiveRecord
{

    public $faq_service_rel;
    public $faq_articles_rel;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faq_title', 'faq_query', 'faq_answer'], 'required'],
            [['patient_name', 'patient_mail', 'patient_phone', 'faq_title', 'faq_query', 'keywords', 'faq_answer', 'alias'], 'string'],
            [['faq_sort', 'doctor_for_answer_id', 'old_id'], 'integer'],
            [['faq_service_rel', 'faq_articles_rel'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'faq_id' => 'ID',
            'patient_name' => 'Имя пациента',
            'patient_mail' => 'Почта пациента',
            'patient_phone' => 'Телефон пациента',
            'faq_sort' => 'Сортировка на странице Вопрос-ответ',
            'doctor_for_answer_id' => 'Отвечающий доктор',
            'faq_service_rel' => 'Связанные услуги',
            'faq_articles_rel' => 'Связанные статьи',
            'faq_title' => 'Заголовок',
            'faq_query' => 'Вопрос',
            'keywords' => 'Ключевые слова',
            'faq_answer' => 'Ответ',
            'alias' => 'Alias',
            'old_id' => 'Old ID',
        ];
    }

    public function getDoctor(){
        return $this->hasOne(Doctors::className(), ['doctor_id' => 'doctor_for_answer_id'])
            ->joinWith('medicalSpecialties');
    }

    public function updateArticleRelations(){

        if (!empty($this->faq_articles_rel)) {
    
            foreach (ArticlesFaqRel::find()->where(['faq_id' => $this->faq_id])->all() as $item) {
                if (array_search($item->article_id, $this->faq_articles_rel) === false) {
                    $item->delete();
                }
            }
            
            foreach ($this->faq_articles_rel as $article) {
                $faqArticle = new ArticlesFaqRel();
                $faqArticle->faq_id = $this->faq_id;
                $faqArticle->article_id = $article;
                if (!ArticlesFaqRel::find()->where(['faq_id' => $this->faq_id, 'article_id' => $article])->exists()) {
                    $faqArticle->save();
                }
            }
        } else {
            
            foreach (ArticlesFaqRel::find()->where(['faq_id' => $this->faq_id])->all() as $item) {
                $item->delete();
            }
        }
    }

    public function afterSave($insert, $changedAttributes){

        if (!empty($this->faq_service_rel)) {

            // удаление стёртых значений из таблицы faq_services_rel
            foreach (FaqServicesRel::find()->where(['faq_id' => $this->faq_id])->all() as $item) {
                if (array_search($item->service_id, $this->faq_service_rel) === false) {
                    $item->delete();
                    // echo $item->service_id . ' deleted, ';
                }
            }
            
            // добавление вновь выбранных значений в таблицу faq_services_rel
            foreach ($this->faq_service_rel as $service) {
                $faqService = new FaqServicesRel();
                $faqService->faq_id = $this->faq_id;
                $faqService->service_id = $service;
                if (!FaqServicesRel::find()->where(['faq_id' => $this->faq_id, 'service_id' => $service])->exists()) {
                    $faqService->save();
                    // echo $faqService->service_id . ' saved, ';
                }
            }
        } else {

            foreach (FaqServicesRel::find()->where(['faq_id' => $this->faq_id])->all() as $item) {
                $item->delete();
                // echo $item->service_id . ' deleted, ';
            }
        }
        // print_r($this->faq_service_rel);
        // exit;

        $this->updateArticleRelations();

        parent::afterSave($insert, $changedAttributes);
    }
}
