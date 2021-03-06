<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;
use yii\helpers\Json;
use frontend\controllers\MainController;
use backend\models\Clinics;
use backend\models\Doctors;
use backend\models\Reviews;
use backend\models\MedicalSpecialties;
use backend\models\DoctorsMedSpec;
use backend\models\DoctorsPageSort;
use backend\models\SeoSinglePages;
use common\html_constructor\models\HcDraft;

// use backend\models\DoctorsAndClinics;
// use backend\models\Servises;
// use backend\models\DoctorsServicesRel;
// use backend\models\Faq;
// use backend\models\FaqServicesRel;

class SpecialistsController extends MainController
{

  public function actionIndex(){
    $seo = SeoSinglePages::findOne(5);

    $this->setSeo([
      'title' => $seo->title,
      'desc' => $seo->description,
      'kw' => $seo->keywords,
    ]);

    $clinics = Clinics::find()->all();
    $medicalSpecialties = MedicalSpecialties::find()
      ->where(['is_active' => 1])
      ->orderBy(['specialty_sort' => SORT_ASC])
      ->all(); 

    // $servises = Servises::find()->all();
    // foreach ($servises as $servise) {
    //   $meds = explode('||', $servise->medic_to_service);
    //   foreach ($meds as $med) {
    //     if ($med === '41') {
    //       // echo $servise->servise_id;
    //       // echo '<br>';
    //       $tmp = new DoctorsServicesRel();
    //       $tmp->doctor_id = 8;
    //       $tmp->service_id = $servise->servise_id;
    //       $tmp->save();

    //     }
    //   }
        // $servise->save();
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
      ->with('doctorsVideos')
      ->with('doctorsLizenzes')
      ->with('reviews')
      ->where(['doctors.alias' => $doctor])
      ->one();

    if (!empty($doc)){
      $this->setSeo($doc->getSeo());
    } else {
      throw new \yii\web\NotFoundHttpException();
    }

    $rawDraft = HcDraft::find()
    ->where(['id' => $doc->doctor_hc_draft_id])
    ->one();

    $draft = $rawDraft->getHtml();
    $headings = $rawDraft->getTableOfContentsArray();
    
    // print_r($doc->doctorsGalleries);
    
    $microdata = $doc->getMicroData($doc);


    if ($doc !== ''){
      return $this->render('doctorPage.twig', array(
        'doc' => $doc,
        'draft' => $draft,
        'headings' => $headings,
        'microdata' => $microdata,
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

  public function setSeo($seo){

    if (!empty($seo)) {
       $this->view->title = $seo['title'];
       $this->view->params['desc'] = $seo['desc'];
       $this->view->params['kw'] = $seo['kw'];
    } else {
       $this->view->title = '?????????? ?????????????????????? ?????? ?? ????????????';
       $this->view->params['desc'] = '?????? ?????????????? ?? ?????????????? ?????????? ???????????????????????? ?????? ?? ????????????. ?????????????????? ????????????????????';
       $this->view->params['kw'] = '';
    }
}
}