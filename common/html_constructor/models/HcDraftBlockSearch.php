<?php

namespace common\html_constructor\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HcDraftBlock represents the model behind the search form about `common\html_constructor\models\HcDraftBlock`.
 */
class HcDraftBlockSearch extends HcDraftBlock
{

	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function rules() {
		return [
			[['id', 'hc_draft_id', 'hc_block_id', 'sort'], 'integer'],
			[['content'], 'safe'],
		];
	}


	/**
	 *
	 * @inheritdoc
	 * @return unknown
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}


	/**
	 * Creates data provider instance with search query applied
	 *
	 *
	 * @param array   $params
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = HcDraftBlock::find();

		$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
				'id' => $this->id,
				'hc_draft_id' => $this->hc_draft_id,
				'hc_block_id' => $this->hc_block_id,
				'sort' => $this->sort,
			]);

		$query->andFilterWhere(['like', 'content', $this->content]);

		return $dataProvider;
	}


}
