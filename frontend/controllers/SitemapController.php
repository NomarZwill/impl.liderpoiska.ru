<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\controllers\MainController;
use backend\models\Servises;
use backend\models\Doctors;
use backend\models\Clinics;
use backend\models\MedicalSpecialties;
use backend\models\Deals;



class SitemapController extends MainController
{
  public function actionIndex(){

    Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
    Yii::$app->response->headers->add('Content-Type', 'text/xml');

    $host = $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST'];

    $services = Servises::find()
      ->where(['is_active' => 1])
      ->all();
    $doctors = Doctors::find()
      ->where(['is_active' => 1])
      ->all();
    $clinics = Clinics::find()
      ->where(['is_active' => 1])
      ->all();
    $specialities = MedicalSpecialties::find()
      ->where(['is_active' => 1])
      ->all();
    $deals = Deals::find()
      ->where(['is_active' => 1])
      ->all();

    return $this->renderPartial('index.twig', array(
      'host' => $host,
      'services' => $services,
      'doctors' => $doctors,
      'clinics' => $clinics,
      'specialities' => $specialities,
      'deals' => $deals,
    ));

  }
  
}