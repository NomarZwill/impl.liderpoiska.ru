<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Servises;

/**
 * ServisesSearch represents the model behind the search form of `backend\models\Servises`.
 */
class ServisesSearch extends Servises
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['servise_id', 'index_id', 'servise_listing_id', 'parent_id', 'old_id'], 'integer'],
            [['servise_title', 'servise_long_title', 'servise_description', 'introtext', 'alias', 'menu_title', 'content', 'image', 'head_text', 'service_to_price_list', 'price_to_service', 'medic_to_service', 'review_to_service', 'query_to_service', 'padej_predl', 'keywords', 'price_title', 'review_title', 'faq_title', 'medic_title'], 'safe'],
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
        $query = Servises::find();

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
            'servise_id' => $this->servise_id,
            'index_id' => $this->index_id,
            'servise_listing_id' => $this->servise_listing_id,
            'parent_id' => $this->parent_id,
            'old_id' => $this->old_id,
        ]);

        $query->andFilterWhere(['like', 'servise_title', $this->servise_title])
            ->andFilterWhere(['like', 'servise_long_title', $this->servise_long_title])
            ->andFilterWhere(['like', 'servise_description', $this->servise_description])
            ->andFilterWhere(['like', 'introtext', $this->introtext])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'menu_title', $this->menu_title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'head_text', $this->head_text])
            ->andFilterWhere(['like', 'service_to_price_list', $this->service_to_price_list])
            ->andFilterWhere(['like', 'price_to_service', $this->price_to_service])
            ->andFilterWhere(['like', 'medic_to_service', $this->medic_to_service])
            ->andFilterWhere(['like', 'review_to_service', $this->review_to_service])
            ->andFilterWhere(['like', 'query_to_service', $this->query_to_service])
            ->andFilterWhere(['like', 'padej_predl', $this->padej_predl])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'price_title', $this->price_title])
            ->andFilterWhere(['like', 'review_title', $this->review_title])
            ->andFilterWhere(['like', 'faq_title', $this->faq_title])
            ->andFilterWhere(['like', 'medic_title', $this->medic_title]);

        return $dataProvider;
    }
}
