<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\controllers\MainController;
use backend\models\Clinics;
use backend\models\Doctors;
use backend\models\Deals;
use backend\models\Servises;
use backend\models\Prices;
use backend\models\ServiceAndPrices;
use backend\models\Reviews;
use backend\models\Faq;
use common\models\api\Maps;


class OtherController extends MainController
{

  public function actionIndex(){
    // return $this->render('index.twig');
  }

  public function actionAgreement(){

    return $this->render('agreement.twig', array(
    ));
  }

  public function actionContacts(){
    $clinics = Clinics::find()->asArray()->all();

    // $clinics = Clinics::find()->one();

    // foreach ($clinics as $clinic){
    //   $clinic->clinic_phone = html_entity_decode($clinic->clinic_phone, ENT_HTML5);
    //   $clinic->save();
    // }

    // print_r(json_encode($maps));
    // print_r(html_entity_decode($clinics->clinic_opening_hours, ENT_HTML5));
    // exit;
    
    return $this->render('contacts.twig', array(
      'clinics' => $clinics
    ));
  }

  public function actionClinicContacts($clinic){
    $currentClinic = Clinics::find()->where(['clinics.alias' => $clinic])->asArray()->one();
    $doctors = Doctors::find()
            ->joinWith('medicalSpecialties')
            ->asArray()
            ->all();     
    
    return $this->render('clinicContacts.twig', array(
      'clinic' => $currentClinic,
      'doctors' => $doctors
    ));
  }

  public function actionPartners(){

    return $this->render('partners.twig');
  }

  public function actionPrices(){

    $firstLevelParents = Servises::find()->where(['servises.parent_id' => 0])->asArray()->all();

    $firstLevelServices = Servises::find()
    ->where(['servises.parent_id' => 0])
    ->joinWith('prices')
    ->asArray()
    ->all();   
    // print_r($firstLevelServices[0]);
    // exit;

    // foreach ($firstLevelParents as $firstLevelParent ){
    //   $prices = explode('||', $firstLevelParent['price_to_service']);

    //   foreach ($prices as $price){
    //     $price_row = Prices::find()->where(['prices.old_id' => $price])->asArray()->one();

    //     $midTableRow = new ServiceAndPrices;
    //     $midTableRow->service_id = $firstLevelParent['servise_id'];
    //     $midTableRow->prices_id = $price_row['prices_id'];
    //     $midTableRow->save();
    //   }
    // }

    return $this->render('prices.twig', array(
      'firstLevelServices' => $firstLevelServices
    ));  
  }

  public function actionAbout(){

    return $this->render('about.twig');  
  }

  public function actionSpecialDeals(){
    $deals = Deals::find()->asArray()->all();

    return $this->render('specialDealsListing.twig', array(
      'deals' => $deals
    ));  
   }

  public function actionSpecialDeal($deal){
    $deal = Deals::find()->where(['deals.alias' => $deal])->asArray()->one();

    return $this->render('specialDealPage.twig', array(
      'deal' => $deal
    ));  
  }
  
  public function actionReviews(){
    $reviews = Reviews::find()
      ->where(['year' => date('Y')])
      ->limit(5)
      ->all();
    $yearsList = Reviews::getYearsList();
    // print_r($yearsList);
    // exit;

    return $this->render('reviews.twig', array(
      'yearsList' => $yearsList,
      'activeYear' => date('Y'),
      'singleYearReviews' => $reviews,
    ));  
  }

  public function actionAjaxReviewsSingleYear(){
    $activeYear = $_GET['activeYear'];
    $reviews = Reviews::find()
      ->where(['year' => $activeYear])
      ->limit(5)
      ->all();

    return json_encode([
      'listing' => $this->renderPartial('/components/reviews_page_listing.twig', array(
        'singleYearReviews' => $reviews,
      )),
    ]);
  }

  public function actionAjaxGetMoreReviews(){
    $activeYear = $_GET['activeYear'];
    $previousReviewCount = $_GET['previousReviewCount'];
    $reviews = Reviews::find()
      ->where(['year' => $activeYear])
      ->offset($previousReviewCount)
      ->limit(5)
      ->all();
    $isListEnd = (count($reviews) < 5) ? true : false;

    return json_encode([
      'listing' => $this->renderPartial('/components/reviews_page_listing.twig', array(
        'singleYearReviews' => $reviews,
      )),
      'isListEnd' => $isListEnd
    ]);
  }

  public function actionFaq(){
    $faq = Faq::find()
      ->limit(7)
      ->all();

    $doctors = Doctors::find()
      ->joinWith('medicalSpecialties')
      ->all();  

    return $this->render('faqPage.twig', array(
      'faq' => $faq,
      'doctors' => $doctors,
    ));  
  }

  public function actionAjaxGetMoreFaq(){
    $previousFaqCount = $_GET['previousFaqCount'];
    $faq = Faq::find()
      ->offset($previousFaqCount)
      ->limit(5)
      ->all();
    $isListEnd = (count($faq) < 5) ? true : false;

    return json_encode([
      'listing' => $this->renderPartial('/components/faq.twig', array(
        'faq' => $faq,
      )),
      'isListEnd' => $isListEnd
    ]);
  }

  public function actionLicenses(){

    return $this->render('licenses.twig'); 
  }

  public function actionWarranty(){

    return 'actionWarranty';
  }
}