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
  public function actionSpecialityName($specID){
    $medicalSpecialtiesAll = MedicalSpecialties::find()->asArray()->all(); 
    $medicalSpecialties = MedicalSpecialties::find()
      ->where(['medical_specialties.alias' => $specID])
      ->joinWith('doctors')
      ->asArray()
      ->all(); 

    // print_r($medicalSpecialties);
    // exit;
      
    return $this->render('index.twig', array(
      'medicalSpecialties' => $medicalSpecialties,
      'medicalSpecialtiesAll' => $medicalSpecialtiesAll
    ));
  }
}