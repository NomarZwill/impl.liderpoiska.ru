<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use backend\models\Servises;
use backend\models\Clinics;

class MainController extends Controller{

  public function beforeAction($action){
    $servises = Servises::find()->asArray()->all();
    Servises::setFirstLevelChildCount($servises);
    $clinics = Clinics::find()->all();

    Yii::$app->params['servises'] = $servises;
    Yii::$app->params['clinics'] = $clinics;
    return parent::beforeAction($action);
  }

  

}
