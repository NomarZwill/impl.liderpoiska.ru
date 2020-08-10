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
    $doctors = Doctors::find()
      ->joinWith('medicalSpecialties')
      ->limit(20)
      ->asArray()
      ->all();

    // print_r(count($doctors));
    // echo count($doctors);
    // exit;
      
    return $this->render('index.twig', array(
      'clinics' => $clinics,
      'doctors' => $doctors,
      'medicalSpecialties' => $medicalSpecialties,
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

  public function actionAjaxMedSpecFilter(){
    $filterSetting = $_GET['spec_id'];

    return $this->getFilteredMedSpecList($filterSetting, 20, 0);
  }

  public function actionAjaxMoreCard(){
    $spec_id = $_GET['spec_id'];
    $cardCount = $_GET['currentCardCount'];

    return $this->getFilteredMedSpecList($spec_id, 20, $cardCount);
  }

  public function getFilteredMedSpecList($spec_id, $limit, $offset){

    if ($spec_id === '0') {
      // $doctors = Doctors::find()->limit($limit)->offset($offset)->asArray()->all();
      // $doctorsAndMedSpec = SpecialistsController::getDoctorsAndMedSpecList(Doctors::find()->all());
      $doctors = Doctors::find()
        ->joinWith('medicalSpecialties')
        ->limit($limit)
        ->offset($offset)
        ->asArray()
        ->all();

      $isListEnd = (count($doctors) < $limit) ? true : false;

      return json_encode([
        'listing' => $this->renderPartial('/components/doctorListing.twig', array(
          'doctors' => $doctors,
          // 'doctorsAndMedSpec' => $doctorsAndMedSpec
        )),
        'isListEnd' => $isListEnd,
        'doctors' => $doctors
      ]);
    } else {
      $doctors = Doctors::find()
        ->joinWith('medicalSpecialties')
        ->where(['doctors_med_spec.specialty_id' => $spec_id])
        ->limit($limit)
        ->offset($offset)
        ->asArray()
        ->all();
  
      return json_encode([
        'listing' => $this->renderPartial('/components/doctorListing.twig', array(
          'doctors' => $doctors,
        )),
        'doctors' => $doctors
      ]);
    }
  }


  public static function getDoctorsAndMedSpecList($doctors){
    $doctorsAndMedSpec = [];
    
    foreach ($doctors as $doc) {
      $medSpec = $doc->medicalSpecialties;
      
      if (count($medSpec) > 1) {
          
        foreach ($medSpec as $spec) {
          $doctorsAndMedSpec[$doc->doctor_id][$spec->specialty_id] = $spec->menu_title;
        } 
        
      } elseif (count($medSpec) == 1) {
          $doctorsAndMedSpec[$doc->doctor_id][$medSpec[0]->specialty_id] = $medSpec[0]->menu_title;
      }
    }

    return $doctorsAndMedSpec;
  }
}