<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Doctors;

/**
 * DoctorsSearch represents the model behind the search form of `backend\models\Doctors`.
 */
class DoctorsSearch extends Doctors
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'old_id'], 'integer'],
            [['doctor_title', 'doctor_long_title', 'doctor_description', 'introtext', 'alias', 'content', 'doctor_education', 'doctor_image', 'medic_to_filial', 'sort_lab_smail', 'sort_doyche_velle', 'sort_esteticheskaya_stomatologiya_chistie_prudi', 'sort_esteticheskaya_stomatologiya', 'sort_impl', 'sort_centr_implantologii', 'review_to_specials', 'specials_to_medic', 'review_title', 'query_to_service', 'faq_title', 'sort_klinika_dentalgeneva', 'sort_prec_1005', 'sort_prec_1154', 'sort_prec_1459', 'sort_prec_988', 'sort_prec_989', 'sort_prec_990', 'sort_prec_991', 'sort_prec_992', 'sort_prec_994'], 'safe'],
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
        $query = Doctors::find();

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
            'doctor_id' => $this->doctor_id,
            'old_id' => $this->old_id,
        ]);

        $query->andFilterWhere(['like', 'doctor_title', $this->doctor_title])
            ->andFilterWhere(['like', 'doctor_long_title', $this->doctor_long_title])
            ->andFilterWhere(['like', 'doctor_description', $this->doctor_description])
            ->andFilterWhere(['like', 'introtext', $this->introtext])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'doctor_education', $this->doctor_education])
            ->andFilterWhere(['like', 'doctor_image', $this->doctor_image])
            ->andFilterWhere(['like', 'medic_to_filial', $this->medic_to_filial])
            ->andFilterWhere(['like', 'sort_lab_smail', $this->sort_lab_smail])
            ->andFilterWhere(['like', 'sort_doyche_velle', $this->sort_doyche_velle])
            ->andFilterWhere(['like', 'sort_esteticheskaya_stomatologiya_chistie_prudi', $this->sort_esteticheskaya_stomatologiya_chistie_prudi])
            ->andFilterWhere(['like', 'sort_esteticheskaya_stomatologiya', $this->sort_esteticheskaya_stomatologiya])
            ->andFilterWhere(['like', 'sort_impl', $this->sort_impl])
            ->andFilterWhere(['like', 'sort_centr_implantologii', $this->sort_centr_implantologii])
            ->andFilterWhere(['like', 'review_to_specials', $this->review_to_specials])
            ->andFilterWhere(['like', 'specials_to_medic', $this->specials_to_medic])
            ->andFilterWhere(['like', 'review_title', $this->review_title])
            ->andFilterWhere(['like', 'query_to_service', $this->query_to_service])
            ->andFilterWhere(['like', 'faq_title', $this->faq_title])
            ->andFilterWhere(['like', 'sort_klinika_dentalgeneva', $this->sort_klinika_dentalgeneva])
            ->andFilterWhere(['like', 'sort_prec_1005', $this->sort_prec_1005])
            ->andFilterWhere(['like', 'sort_prec_1154', $this->sort_prec_1154])
            ->andFilterWhere(['like', 'sort_prec_1459', $this->sort_prec_1459])
            ->andFilterWhere(['like', 'sort_prec_988', $this->sort_prec_988])
            ->andFilterWhere(['like', 'sort_prec_989', $this->sort_prec_989])
            ->andFilterWhere(['like', 'sort_prec_990', $this->sort_prec_990])
            ->andFilterWhere(['like', 'sort_prec_991', $this->sort_prec_991])
            ->andFilterWhere(['like', 'sort_prec_992', $this->sort_prec_992])
            ->andFilterWhere(['like', 'sort_prec_994', $this->sort_prec_994]);

        return $dataProvider;
    }
}
