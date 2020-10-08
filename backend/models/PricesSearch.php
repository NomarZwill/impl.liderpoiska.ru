<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Prices;

/**
 * PricesSearch represents the model behind the search form of `backend\models\Prices`.
 */
class PricesSearch extends Prices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prices_id', 'price', 'old_id'], 'integer'],
            [['prices_name', 'price_hide', 'keywords', 'code', 'alias'], 'safe'],
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
        $query = Prices::find();

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
            'prices_id' => $this->prices_id,
            'price' => $this->price,
            'old_id' => $this->old_id,
        ]);

        $query->andFilterWhere(['like', 'prices_name', $this->prices_name])
            ->andFilterWhere(['like', 'price_hide', $this->price_hide])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
