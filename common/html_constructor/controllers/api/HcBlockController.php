<?php

namespace common\html_constructor\controllers\api;

/**
 * This is the class for REST controller "HcBlockController".
 */

use common\html_constructor\models\HcBlock;

class HcBlockController extends \yii\rest\ActiveController
{
	public $modelClass = HcBlock::class;
	public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function actions()
  {
    $actions = parent::actions();
    $actions['index']['prepareDataProvider'] = function ($action, $filter) {
      $model = new $this->modelClass;
      $query = $model::find();
      if (!empty($filter)) {
        $query->andWhere($filter);
      }
      $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => $query,
        'pagination' => false,
      ]);
      return $dataProvider;
    };
    return $actions;
  }
}
