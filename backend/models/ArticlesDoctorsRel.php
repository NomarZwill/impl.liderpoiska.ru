<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "articles_doctors_rel".
 *
 * @property int $id
 * @property int $article_id
 * @property int $doctor_id
 */
class ArticlesDoctorsRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles_doctors_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'doctor_id'], 'required'],
            [['article_id', 'doctor_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'doctor_id' => 'Doctor ID',
        ];
    }

    public function getDoctorArticleIDs($doctorID){
        $doctorArticleIDList = [];
        $doctorArticleList = ArticlesDoctorsRel::find()->where(['doctor_id' => $doctorID])->all();

        foreach ($doctorArticleList as $item) {
            $doctorArticleIDList[] = $item->article_id;
        }
        return $doctorArticleIDList;
            
    }
}
