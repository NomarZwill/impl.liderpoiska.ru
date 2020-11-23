<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\controllers\MainController;
use backend\models\Clinics;
use backend\models\Doctors;
use backend\models\Reviews;
use backend\models\MedicalSpecialties;
use backend\models\DoctorsMedSpec;
use backend\models\DoctorsPageSort;
use common\html_constructor\models\HcDraft;

// use backend\models\DoctorsAndClinics;
use backend\models\Servises;
// use backend\models\DoctorsServicesRel;
// use backend\models\Faq;
// use backend\models\FaqServicesRel;

class SpecialistsController extends MainController
{

  public function actionIndex(){
    $clinics = Clinics::find()->all();
    $medicalSpecialties = MedicalSpecialties::find()
      ->where(['is_active' => 1])
      ->orderBy(['specialty_sort' => SORT_ASC])
      ->all(); 

    // $servises = Servises::find()->all();
    // $i = 1;
    // foreach ($servises as $servise) {
    //   if ($servise->parent_id !== 0) {
    //     $parentService = Servises::find()->where(['old_id' => $servise->parent_id])->one();
    //     echo "Цикл " . $i . ", старый parent_id = " . $servise->parent_id . ", новый parent_id = " . $parentService->servise_id . "<br>";
    //     $servise->parent_id = $parentService->servise_id;
    //     $servise->save();
    //   } else {
    //     echo "Цикл " . $i . ", категория, parent_id = 0" . "<br>";
    //   }
    //   $i++;
    // }
    // exit;

    return $this->render('index.twig', array(
      'clinics' => $clinics,
      'medicalSpecialties' => $medicalSpecialties,
    ));
  }

  public function actionSpecialistCard($doctor){
    // phpinfo();
    // exit;

    $doc = Doctors::find()
      ->joinWith('medicalSpecialties')
      ->joinWith('doctorsAndClinics')
      ->joinWith('doctorsGalleries')
      ->joinWith('reviews')
      ->where(['doctors.alias' => $doctor])
      ->one();

    $draft = HcDraft::find()
    ->where(['id' => $doc->doctor_hc_draft_id])
    ->one()
    ->getHtml();
    
    // print_r($doc->doctorsGalleries);
    

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
        ->where(['doctors.is_active' => 1])
        ->joinWith('medicalSpecialties')
        ->distinct('id')
        ->orderBy(['doctor_listing_sort' => SORT_ASC])
        ->offset($offset)
        ->limit($limit)
        ->all();

      Doctors::modifyExperienceString($doctors);

      $isListEnd = (count($doctors) < $limit) ? true : false;

      return json_encode([
        'listing' => $this->renderPartial('/components/doctorListing.twig', array(
          'doctors' => $doctors,
          'pageType' => 'listing',
        )),
        'isListEnd' => $isListEnd,
        'doctors' => $doctors
      ]);
    } else {

      $allData = DoctorsPageSort::find()
        ->where(['page_type' => 'medSpeciality', 'page_id' =>  $spec_id])
        ->orderBy(['sort_index' => SORT_ASC])
        ->joinWith('doctors')
        ->distinct('id')
        ->offset($offset)
        ->limit($limit)
        ->all();

      foreach ($allData as $item) {

        foreach ($item->doctors as $doctor) {
          $doctor->doctor_experience = Doctors::num_decline($doctor->doctor_experience);
        }
      }

        $isListEnd = (count($allData) < $limit) ? true : false;
  
      return json_encode([
        'listing' => $this->renderPartial('/components/doctorListing.twig', array(
          'allData' => $allData,
          'pageType' => 'medSpec',
        )),
        'isListEnd' => $isListEnd,
      ]);
    }
  }
}