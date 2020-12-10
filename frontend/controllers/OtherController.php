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
use backend\models\SeoSinglePages;
use backend\models\Banners;
use common\models\api\Maps;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;


class OtherController extends MainController
{

  public function actionIndex(){
    // return $this->render('index.twig');
  }

  public function actionTesta(){
    $items = Clinics::find()
      ->where(['clinics.is_active' => 1])
      ->joinWith('imageGalleries')
      ->all();
    
    foreach ($items as $item) {
      $path = 'images/uploaded/clinics/'.$item->clinic_id.'/';
      foreach ($item->imageGalleries as $image) {
        $file_name = basename($image->filepath);

        $alias_front = Yii::getAlias('@frontend/web');
        Image::getImagine()
            ->open($alias_front . '/' . $path . $file_name)
            ->thumbnail(new Box(612, 334))
            ->save($alias_front . '/' . $path . $file_name , ['quality' => 90]);
      }
    }
    
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

    $seo = SeoSinglePages::findOne(4);

    $this->setSeo([
      'title' => $seo->title,
      'desc' => $seo->description,
      'kw' => $seo->keywords,
    ]);

    // $this->setSeo([
    //   'title' => 'Филиалы ЦЭС',
    //   'desc' => 'Адреса и телефоны всех филиалов ГК ЦЭС здесь: подробная информация о всех стоматологических клиниках в ЦЭС в Москве',
    //   'kw' => '',
    // ]);

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
      ->joinWith('imageGalleries')
      ->with('reviews')
      ->with('bunnersForClinics')
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

    $seo = SeoSinglePages::findOne(8);

    $this->setSeo([
      'title' => $seo->title,
      'desc' => $seo->description,
      'kw' => $seo->keywords,
    ]);

    $gifts = PartnersDeals::find()->where(['is_active' => 1])->all();

    // print_r($gifts);
    // exit;

    return $this->render('partners.twig', array(
      'gifts' => $gifts
    ));
  }

  public function actionPrices(){

    $seo = SeoSinglePages::findOne(3);

    $this->setSeo([
      'title' => $seo->title,
      'desc' => $seo->description,
      'kw' => $seo->keywords,
    ]);

    $firstLevelParents = Servises::find()
      ->where(['servises.parent_id' => 0, 'servises.is_active' => 1])
      ->asArray()
      ->all();

    $firstLevelServices = Servises::find()
    ->where(['servises.parent_id' => 0, 'servises.is_active' => 1])
    ->joinWith('prices')
    ->with('bunnersForRootServices')
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
      'firstLevelServices' => $firstLevelServices,
    ));  
  }

  public function actionAbout(){

    $seo = SeoSinglePages::findOne(6);

    $this->setSeo([
      'title' => $seo->title,
      'desc' => $seo->description,
      'kw' => $seo->keywords,
    ]);

    return $this->render('about.twig');  
  }

  public function actionSpecialDeals(){

    $seo = SeoSinglePages::findOne(9);

    $this->setSeo([
      'title' => $seo->title,
      'desc' => $seo->description,
      'kw' => $seo->keywords,
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

    $seo = SeoSinglePages::findOne(10);

    $this->setSeo([
      'title' => $seo->title,
      'desc' => $seo->description,
      'kw' => $seo->keywords,
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

    $seo = SeoSinglePages::findOne(11);

    $this->setSeo([
      'title' => $seo->title,
      'desc' => $seo->description,
      'kw' => $seo->keywords,
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

    $seo = SeoSinglePages::findOne(12);

    $this->setSeo([
      'title' => $seo->title,
      'desc' => $seo->description,
      'kw' => $seo->keywords,
    ]);

    return $this->render('licenses.twig', array(
      'pageMedia' => $pageMedia,
    )); 
  }

  public function actionWarranty(){

    $seo = SeoSinglePages::findOne(2);

    $this->setSeo([
      'title' => $seo->title,
      'desc' => $seo->description,
      'kw' => $seo->keywords,
    ]);

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