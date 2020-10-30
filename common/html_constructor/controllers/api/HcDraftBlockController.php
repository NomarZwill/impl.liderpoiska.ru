<?php

namespace common\html_constructor\controllers\api;

/**
 * This is the class for REST controller "HcDraftBlockController".
 */

use common\html_constructor\models\HcDraftBlock;
use common\html_constructor\models\HcDraftBlockSearch;
use common\html_constructor\models\utility\SortableTrait;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;

class HcDraftBlockController extends \yii\rest\ActiveController
{
	use SortableTrait;

	public $modelClass = HcDraftBlock::class;
	public $serializer = [
		'class' => 'yii\rest\Serializer',
		'collectionEnvelope' => 'items',
	];

	public function actions()
	{
		$actions = parent::actions();
		$actions['index']['dataFilter'] = [
            'class' => 'yii\data\ActiveDataFilter',
            'searchModel' => HcDraftBlockSearch::class
		];
		$actions['index']['prepareDataProvider'] = function ($action, $filter) {
			$model = new $this->modelClass;
			$query = $model::find();
			if (!empty($filter)) {
				$query->andWhere($filter);
			}
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
				'pagination' => false,

			]);
			return $dataProvider;
		};
		return $actions;
	}

	public function actionSort()
	{
		if (!$items = \Yii::$app->request->post('items')) {
			throw new BadRequestHttpException('Don\'t received POST param `items`.');
		}
		/** @var \yii\db\ActiveRecord $model */
		$model = new $this->modelClass;
		$items = Json::decode($items);
		foreach ($items as $id => $sort) {
			$models[$id] = $model::findOne($id);
			$newOrder[$id] = $sort;
		}
		return $model::getDb()->transaction(function () use ($models, $newOrder) {
			$rowsUpdated = 0;
			foreach ($newOrder as $modelId => $newSort) {
				/** @var ActiveRecord[] $models */
				$rowsUpdated += $models[$modelId]->updateAttributes(['sort' => $newSort]);
			}
			return $rowsUpdated;
		});
	}
}
