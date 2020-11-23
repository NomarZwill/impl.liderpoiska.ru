<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Deals;

/**
 * DealsSearch represents the model behind the search form of `backend\models\Deals`.
 */
class DealsSearch extends Deals
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deals_id', 'old_id'], 'integer'],
            [['deals_title', 'deals_long_title', 'deals_description', 'deals_index_description', 'alias', 'deals_image_front', 'deals_image_back', 'deals_content'], 'safe'],
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
        $query = Deals::find();

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
            'deals_id' => $this->deals_id,
            'old_id' => $this->old_id,
        ]);

        $query->andFilterWhere(['like', 'deals_title', $this->deals_title])
            ->andFilterWhere(['like', 'deals_long_title', $this->deals_long_title])
            ->andFilterWhere(['like', 'deals_description', $this->deals_description])
            ->andFilterWhere(['like', 'deals_index_description', $this->deals_index_description])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'deals_image_front', $this->deals_image_front])
            ->andFilterWhere(['like', 'deals_image_back', $this->deals_image_back])
            ->andFilterWhere(['like', 'deals_content', $this->deals_content]);

        return $dataProvider;
    }
}
