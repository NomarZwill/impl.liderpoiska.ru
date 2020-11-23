<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Clinics;

/**
 * ClinicsSearch represents the model behind the search form of `backend\models\Clinics`.
 */
class ClinicsSearch extends Clinics
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clinic_id', 'old_id'], 'integer'],
            [['clinic_title', 'clinic_long_title', 'clinic_description', 'alias', 'card_title', 'content', 'clinic_address', 'clinic_address_short', 'clinic_phone', 'clinic_whatsapp', 'clinic_mail', 'clinic_site', 'clinic_coords', 'clinic_opening_hours', 'clinic_map', 'main_phone', 'keywords', 'review_to_filial', 'review_title', 'bottom_text'], 'safe'],
            [['clinic_latitude', 'clinic_longitude'], 'number'],
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
        $query = Clinics::find();

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
            'clinic_id' => $this->clinic_id,
            'clinic_latitude' => $this->clinic_latitude,
            'clinic_longitude' => $this->clinic_longitude,
            'old_id' => $this->old_id,
        ]);

        $query->andFilterWhere(['like', 'clinic_title', $this->clinic_title])
            ->andFilterWhere(['like', 'clinic_long_title', $this->clinic_long_title])
            ->andFilterWhere(['like', 'clinic_description', $this->clinic_description])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'card_title', $this->card_title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'clinic_address', $this->clinic_address])
            ->andFilterWhere(['like', 'clinic_address_short', $this->clinic_address_short])
            ->andFilterWhere(['like', 'clinic_phone', $this->clinic_phone])
            ->andFilterWhere(['like', 'clinic_whatsapp', $this->clinic_whatsapp])
            ->andFilterWhere(['like', 'clinic_mail', $this->clinic_mail])
            ->andFilterWhere(['like', 'clinic_site', $this->clinic_site])
            ->andFilterWhere(['like', 'clinic_coords', $this->clinic_coords])
            ->andFilterWhere(['like', 'clinic_opening_hours', $this->clinic_opening_hours])
            ->andFilterWhere(['like', 'clinic_map', $this->clinic_map])
            ->andFilterWhere(['like', 'main_phone', $this->main_phone])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'review_to_filial', $this->review_to_filial])
            ->andFilterWhere(['like', 'review_title', $this->review_title])
            ->andFilterWhere(['like', 'bottom_text', $this->bottom_text]);

        return $dataProvider;
    }
}
