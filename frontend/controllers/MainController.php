<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use backend\models\Servises;

class MainController extends Controller{

  public function beforeAction($action){

    Yii::$app->params['servises'] = Servises::find()->asArray()->all();
    return parent::beforeAction($action);
  }

}
