<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\controllers\MainController;
use backend\models\Clinics;
use backend\models\Ratings;
use backend\models\Doctors;
use backend\models\Deals;
use backend\models\Servises;
use backend\models\Prices;
use backend\models\ServiceAndPrices;
use backend\models\Reviews;
use backend\models\Faq;
use backend\models\PartnersDeals;
use backend\models\DoctorsPageSort;
// use backend\models\ReviewDoctorsRel;
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
    $clinics = Clinics::find()
      ->where(['clinics.is_active' => 1])
      ->joinWith('ratings')
      ->joinWith('imageGalleries')
      ->all();

    // print_r($clinics);
    // exit;
    
    return $this->render('contacts.twig', array(
      'clinics' => $clinics,
    ));
  }

  public function actionClinicContacts($clinic){

    $currentClinic = Clinics::find()
      ->where(['clinics.alias' => $clinic])
      ->joinWith('ratings')
      ->with('reviews')
      ->joinWith('imageGalleries')
      ->one();

    $allData = DoctorsPageSort::find()
      ->where(['page_type' => 'clinics', 'page_id' =>  $currentClinic['clinic_id']])
      ->orderBy(['sort_index' => SORT_ASC])
      ->joinWith('doctors')
      ->all();

    foreach ($allData as $item) {

      foreach ($item->doctors as $doctor) {
        $doctor->doctor_experience = Doctors::num_decline($doctor->doctor_experience);
      }
    }
      
    //echo '<pre>';
    //print_r($currentClinic);
    //print_r($currentClinic->reviews);
    //exit;
    
    return $this->render('clinicContacts.twig', array(
      'clinic' => $currentClinic,
      'allData' => $allData
    ));
  }

  public function actionPartners(){

    $gifts = PartnersDeals::find()->where(['is_active' => 1])->all();

    // print_r($gifts);
    // exit;

    return $this->render('partners.twig', array(
      'gifts' => $gifts
    ));
  }

  public function actionPrices(){

    $firstLevelParents = Servises::find()
      ->where(['servises.parent_id' => 0/*, 'is_active' => 1*/])
      ->asArray()
      ->all();

    $firstLevelServices = Servises::find()
    ->where(['servises.parent_id' => 0/*, 'is_active' => 1*/])
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
    $deals = Deals::find()
      ->where(['is_active' => 1])
      ->orderBy(['deals_sort' => SORT_ASC])
      ->all();

    return $this->render('specialDealsListing.twig', array(
      'deals' => $deals
    ));  
   }

  public function actionSpecialDeal($deal){
    $deal = Deals::find()
      ->where(['deals.alias' => $deal, 'is_active' => 1])
      ->one();

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


    // $reviews = Reviews::find()->all();

    // foreach ($reviews as $review) {
    //   if ($review->doctor_id !== 0) {
    //     $docReview = new ReviewDoctorsRel();
    //     $docReview->doctor_id = $review->doctor_id;
    //     $docReview->review_id = $review->review_id;
    //     $docReview->save();
    //   }
    // }
    // print_r($reviews);
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
      ->where(['answers_the_questions' => 1, 'doctors.is_active' => 1])
      ->joinWith('medicalSpecialties')
      ->all();  

    Doctors::modifyExperienceString($doctors);

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