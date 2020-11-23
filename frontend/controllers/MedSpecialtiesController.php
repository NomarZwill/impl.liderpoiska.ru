<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\controllers\MainController;
use backend\models\Doctors;
use backend\models\MedicalSpecialties;
use backend\models\DoctorsMedSpec;

class MedSpecialtiesController extends MainController
{
  public function actionSpecialityName($specAlias){
    $medicalSpecialtiesAll = MedicalSpecialties::find()
      ->orderBy(['specialty_sort' => SORT_ASC])
      ->all(); 
    $activeSpec = MedicalSpecialties::find()
      ->where(['alias' => $specAlias])
      ->joinWith('reviews')
      ->one();

    // print_r($doctors);
    // exit;
      
    return $this->render('index.twig', array(
      'activeSpec' => $activeSpec,
      'medicalSpecialtiesAll' => $medicalSpecialtiesAll
    ));
  }
}