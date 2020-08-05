<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Clinics;
use backend\models\Doctors;
use backend\models\MedicalSpecialties;
use backend\models\DoctorsMedSpec;

class SpecialistsController extends Controller
{

  public function actionIndex(){
    $clinics = Clinics::find()->asArray()->all();
    $medicalSpecialties = MedicalSpecialties::find()->asArray()->all();
    $doctors = Doctors::find()->all();  

    $doctorsAndMedSpec = [];
    
    foreach ($doctors as $doc) {
      $medSpec = $doc->medSpec;
      
      if (count($medSpec) > 1) {
          
        foreach ($medSpec as $spec) {
            
          if (array_key_exists($doc->doctor_id, $doctorsAndMedSpec)) {
            $doctorsAndMedSpec[$doc->doctor_id] = $doctorsAndMedSpec[$doc->doctor_id] . ",<br>" . $spec->menu_title;
          } else {
            $doctorsAndMedSpec[$doc->doctor_id] = $spec->menu_title;
          }
        } 
        
      } elseif (count($medSpec) == 1) {
          $doctorsAndMedSpec[$doc->doctor_id] = $medSpec[0]->menu_title;
      }
    }
      
    $doctors = Doctors::find()->asArray()->all();

    return $this->render('index.twig', array(
      'clinics' => $clinics,
      'doctors' => $doctors,
      'medicalSpecialties' => $medicalSpecialties,
      'doctorsAndMedSpec' => $doctorsAndMedSpec
    ));
  }

  public function actionSpecialistCard($doctor){
    $doc = Doctors::find()->where(['alias' => $doctor])->one();
    // print_r($doc);
    // exit;

    if ($doc !== ''){
      return $this->render('doctorPage.twig', array(
        'doc' => $doc
      ));
    } else {
      echo 'no spec';
    }
  }

  
}