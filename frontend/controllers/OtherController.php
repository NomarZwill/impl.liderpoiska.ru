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
use backend\models\LicensesDocumentsPage;
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
      ->orderBy(['clinic_sort' => SORT_ASC])
      ->all();

    $this->setSeo([
      'title' => 'Филиалы ЦЭС',
      'desc' => 'Адреса и телефоны всех филиалов ГК ЦЭС здесь: подробная информация о всех стоматологических клиниках в ЦЭС в Москве',
      'kw' => '',
    ]);

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

    if (!empty($currentClinic)){
      $this->setSeo($currentClinic->getSeo());
    } else {
      throw new \yii\web\NotFoundHttpException();
    }

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

    $this->setSeo([
      'title' => 'Партнеры ЦЭС',
      'desc' => 'Партнеры ГК ЦЭС в Москве. Предложения от партнеров, скидки',
      'kw' => '',
    ]);

    $gifts = PartnersDeals::find()->where(['is_active' => 1])->all();

    // print_r($gifts);
    // exit;

    return $this->render('partners.twig', array(
      'gifts' => $gifts
    ));
  }

  public function actionPrices(){

    $this->setSeo([
      'title' => 'Цены на стоматологические услуги ЦЭС',
      'desc' => 'Прейскурант цен на стоматологические услуги в Москве. Цены на лечение зубов в клинике «Центр эстетической стоматологии».',
      'kw' => '',
    ]);

    $firstLevelParents = Servises::find()
      ->where(['servises.parent_id' => 0, 'servises.is_active' => 1])
      ->asArray()
      ->all();

    $firstLevelServices = Servises::find()
    ->where(['servises.parent_id' => 0, 'servises.is_active' => 1])
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

    $this->setSeo([
      'title' => 'О компании ЦЭС',
      'desc' => 'Подробная информация про Центр Эстетической стоматологии в Москве. Вступительное слово главного врача',
      'kw' => '',
    ]);

    return $this->render('about.twig');  
  }

  public function actionSpecialDeals(){

    $this->setSeo([
      'title' => 'Спецпредложения от стоматологии ЦЭС',
      'desc' => 'Все спецпредложения и акции от ГК ЦЭС в Москве. Интересные предложения, выгодные условия и скидки',
      'kw' => '',
    ]);

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

    if (!empty($deal)){
      $this->setSeo($deal->getSeo());
    } else {
      throw new \yii\web\NotFoundHttpException();
    }

    return $this->render('specialDealPage.twig', array(
      'deal' => $deal
    ));  
  }
  
  public function actionReviews(){

    $this->setSeo([
      'title' => 'Отзывы о стоматологах Москвы',
      'desc' => 'Отзывы клиентов Центра эстетической стоматологии в Москве: честные отзывы за долгое время работы',
      'kw' => '',
    ]);

    $reviews = Reviews::find()
      ->where(['year' => date('Y')])
      ->limit(5)
      ->orderBy(['date' => SORT_DESC])
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
      'csrf' => Yii::$app->request->getCsrfToken(),
    ));  
  }

  public function actionAjaxReviewsSingleYear(){
    $activeYear = $_GET['activeYear'];
    $reviews = Reviews::find()
      ->where(['year' => $activeYear])
      ->limit(5)
      ->orderBy(['date' => SORT_DESC])
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
      ->orderBy(['date' => SORT_DESC])
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

    // $tmp = Servises::find()->all();

    // foreach ($tmp as $item) {
    //     echo $item->alias . ' ';
    // }

    // exit;

    $this->setSeo([
      'title' => 'Вопросы и ответы из стоматологии',
      'desc' => 'Вопросы врачам ГК ЦЭС. Подробные ответы специалистов по интересующим вопросам из стоматологии',
      'kw' => '',
    ]);

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
      'csrf' => Yii::$app->request->getCsrfToken(),
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

    $pageMedia = LicensesDocumentsPage::find()
      ->where(['licenses_documents_page.id'=> 1])
      ->joinWith('licenses')
      ->one();

    // echo '<pre>';
    // print_r($pageMedia->licenses);
    // exit;

    $this->setSeo([
      'title' => 'Лицензии и реквизиты ЦЭС',
      'desc' => 'Лицензии и реквизиты ГК ЦЭС. Фото',
      'kw' => '',
    ]);

    return $this->render('licenses.twig', array(
      'pageMedia' => $pageMedia,
    )); 
  }

  public function actionWarranty(){

    return $this->render('warranty.twig', array(
      // 'pageMedia' => $pageMedia,
    ));
  }

  public function setSeo($seo){

    if (!empty($seo)) {
       $this->view->title = $seo['title'];
       $this->view->params['desc'] = $seo['desc'];
       $this->view->params['kw'] = $seo['kw'];
    } else {
       $this->view->title = 'Стоматологическиe услуги в Москве в Центре Эстетической Стоматологии';
       $this->view->params['desc'] = 'Оказание стоматологических услуг в клинике ЦЭС в Москве';
       $this->view->params['kw'] = '';
    }
  }
}