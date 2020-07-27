<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Clinics;
use backend\models\Doctors;

class SpecialistsController extends Controller
{

  public function actionIndex(){
    $clinics = Clinics::find()->asArray()->all();
    $specialists = Doctors::find()->asArray()->all();
    // print_r($clinics);
    // print_r($specialists);

    return $this->render('index.html', array(
      'clinics' => $clinics,
      'specialists' => $specialists
    ));
  }

  public function actionSpecialistCard($doctor){
    $doc = Doctors::find()->where(['alias' => $doctor])->one();
    // print_r($doc);
    // exit;

    if ($doc !== ''){
      return $this->render('specialist-card.html', array(
        'doc' => $doc
      ));
    } else {
      echo 'no spec';
    }
  }

  
}