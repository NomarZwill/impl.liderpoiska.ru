<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MedicalSpecialties;

/**
 * MedicalSpecialtiesSearch represents the model behind the search form of `\backend\models\MedicalSpecialties`.
 */
class MedicalSpecialtiesSearch extends MedicalSpecialties
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['specialty_id', 'old_id'], 'integer'],
            [['specialty_title', 'specialty_long_title', 'specialty_description', 'introtext', 'alias', 'menu_title', 'content', 'speciality_review', 'head_text', 'price_title', 'review_title', 'faq_title', 'medic_to_special', 'query_to_service', 'price_to_service', 'keywords'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MedicalSpecialties::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'specialty_id' => $this->specialty_id,
            'old_id' => $this->old_id,
        ]);

        $query->andFilterWhere(['like', 'specialty_title', $this->specialty_title])
            ->andFilterWhere(['like', 'specialty_long_title', $this->specialty_long_title])
            ->andFilterWhere(['like', 'specialty_description', $this->specialty_description])
            ->andFilterWhere(['like', 'introtext', $this->introtext])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'menu_title', $this->menu_title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'speciality_review', $this->speciality_review])
            ->andFilterWhere(['like', 'head_text', $this->head_text])
            ->andFilterWhere(['like', 'price_title', $this->price_title])
            ->andFilterWhere(['like', 'review_title', $this->review_title])
            ->andFilterWhere(['like', 'faq_title', $this->faq_title])
            ->andFilterWhere(['like', 'medic_to_special', $this->medic_to_special])
            ->andFilterWhere(['like', 'query_to_service', $this->query_to_service])
            ->andFilterWhere(['like', 'price_to_service', $this->price_to_service])
            ->andFilterWhere(['like', 'keywords', $this->keywords]);

        return $dataProvider;
    }
}
