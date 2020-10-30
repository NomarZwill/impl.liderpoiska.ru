<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\controllers\MainController;
use backend\models\Clinics;
use backend\models\Doctors;
use backend\models\DoctorsAndClinics;
use backend\models\MedicalSpecialties;
use backend\models\DoctorsMedSpec;
use common\html_constructor\models\HcDraft;

class SpecialistsController extends MainController
{

  public function actionIndex(){
    $clinics = Clinics::find()->all();
    $medicalSpecialties = MedicalSpecialties::find()->all(); 
    // print_r($doctors);
    // exit;
    
    // $doctors = Doctors::find()->all();
    // $clinicIndex = [
    //   694 => 1,
    //   696 => 2,
    //   170 => 3,
    //   695 => 4,
    //   2082 => 5
    // ];

    // foreach ($doctors as $doctor) {
    //   $doctorClinics = explode('||', $doctor->medic_to_filial);
    //   foreach ($doctorClinics as $doctorClinic) {
    //     $doctors_and_clinics = new DoctorsAndClinics();
    //     $doctors_and_clinics->doctor_id = $doctor->doctor_id;
    //     $doctors_and_clinics->clinic_id = $clinicIndex[$doctorClinic];
    //     $doctors_and_clinics->save();
    //   }
    // }

    return $this->render('index.twig', array(
      'clinics' => $clinics,
      'medicalSpecialties' => $medicalSpecialties,
    ));
  }

  public function actionSpecialistCard($doctor){
    $doc = Doctors::find()
      ->joinWith('medicalSpecialties')
      ->joinWith('doctorsAndClinics')
      // ->joinWith('doctorsHcDraft')
      ->where(['doctors.alias' => $doctor])
      ->one();

    $draft = HcDraft::find()
    ->where(['id' => 2])
    ->one()
    ->getHtml();
    // print_r($draft->getHtml());

    // print_r($doc['doctorsAndClinics']);
    // exit;

    if ($doc !== ''){
      return $this->render('doctorPage.twig', array(
        'doc' => $doc,
        'draft' => $draft,
      ));
    } else {
      echo 'no spec';
    }
  }

  public function actionAjaxMoreCard(){
    $spec_id = $_GET['spec_id'];
    $cardCount = $_GET['currentCardCount'];
    $cardLimit = $_GET['cardLimit'];

    return $this->getFilteredMedSpecList($spec_id, $cardLimit, $cardCount);
  }

  public function getFilteredMedSpecList($spec_id, $limit, $offset){

    if ($spec_id === '0') {
      $doctors = Doctors::find()
        ->joinWith('medicalSpecialties')
        ->distinct('id')
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
    } else {
      $doctors = Doctors::find()
        ->joinWith('medicalSpecialties')
        ->where(['doctors_med_spec.specialty_id' => $spec_id])
        ->distinct('id')
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
}