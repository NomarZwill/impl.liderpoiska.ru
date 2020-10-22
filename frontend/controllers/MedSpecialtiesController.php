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
    $medicalSpecialtiesAll = MedicalSpecialties::find()->all(); 
    // $medicalSpecialties = MedicalSpecialties::find()
    //   ->where(['medical_specialties.alias' => $specID])
    //   ->joinWith('doctors')
    //   ->asArray()
    //   ->all(); 

    $activeSpec = MedicalSpecialties::find()->where(['alias' => $specAlias])->one();

    $doctors = Doctors::find()
      ->joinWith('medicalSpecialties')
      ->where(['doctors_med_spec.specialty_id' => $activeSpec->specialty_id])
      ->limit(8)
      ->all();

    // print_r($doctors);
    // exit;
      
    return $this->render('index.twig', array(
      'doctors' => $doctors,
      'activeSpec' => $activeSpec,
      'medicalSpecialtiesAll' => $medicalSpecialtiesAll
    ));
  }

  public function actionAjaxMoreCard(){
    $spec_id = $_GET['spec_id'];
    $cardCount = $_GET['currentCardCount'];
    $cardLimit = $_GET['cardLimit'];

    return $this->getFilteredMedSpecList($spec_id, $cardLimit, $cardCount);
  }

  public function getFilteredMedSpecList($spec_id, $limit, $offset){
    $doctors = Doctors::find()
      ->joinWith('medicalSpecialties')
      ->where(['doctors_med_spec.specialty_id' => $spec_id])
      ->offset($offset)
      ->limit($limit)
      ->all();

    $isListEnd = (count($doctors) < $limit) ? true : false;

    return json_encode([
      'listing' => $this->renderPartial('/components/doctorListing.twig', array(
        'doctors' => $doctors,
      )),
      'isListEnd' => $isListEnd,
      'doctors' => $doctors
    ]);
    
  }
}