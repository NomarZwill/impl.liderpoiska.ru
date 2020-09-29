<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use backend\models\Servises;

class MainController extends Controller{

  public function beforeAction($action){
    $servises = Servises::find()->asArray()->all();
    Servises::setFirstLevelChildCount($servises);

    Yii::$app->params['servises'] = $servises;
    return parent::beforeAction($action);
  }

}
