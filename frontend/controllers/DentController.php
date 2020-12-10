<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\controllers\MainController;
use backend\models\Servises;
use backend\models\Prices;
use backend\models\Doctors;
use backend\models\DoctorsMedSpec;
use backend\models\Faq;
use backend\models\FaqServicesRel;
use backend\models\DoctorsPageSort;
use backend\models\SeoSinglePages;
use common\html_constructor\models\HcDraft;

class DentController extends MainController
{

   public function actionIndex() {
      // $servises = Servises::find()->all();

      // foreach ($servises as $serviсe) {
      //    $serviсe->head_text = html_entity_decode( $serviсe->head_text, ENT_HTML5);
      //    $serviсe->save();
      // }

      // print_r(html_entity_decode($servises[4]['head_text'], ENT_HTML5));
      // print_r($reviews[1]['review_text']);
      // exit;

      $seo = SeoSinglePages::findOne(7);

      $this->setSeo([
         'title' => $seo->title,
         'desc' => $seo->description,
         'kw' => $seo->keywords,
      ]);

      $servises = Servises::find()
         ->where(['is_active' => 1])
         ->asArray()
         ->all();

      Servises::setFirstLevelChildCount($servises);

      return $this->render('index.twig', array(
         'servises' => $servises
      ));  
   }

   public function actionFirstLevel($firstLevel) {
      $currentService = Servises::find()
         ->where(['alias' => $firstLevel, 'is_active' => 1])
         ->with('reviews')
         ->with('faq')
         ->all();

      if (!empty($currentService[0])){
         $this->setSeo($currentService[0]->getSeo());
      } else {
         throw new \yii\web\NotFoundHttpException();
      }

      $childrenService = Servises::find()
         ->where(['parent_id' => $currentService[0]['servise_id'], 'is_active' => 1])
         ->all();

      $servisesWithPrices = Servises::find()
         ->where(['servises.servise_id' => $currentService[0]['servise_id'], 'servises.is_active' => 1])
         ->joinWith('prices')
         ->all(); 

      $doctors = DoctorsPageSort::find()
         ->where(['page_type' => 'services', 'page_id' => $currentService[0]['servise_id']])
         ->orderBy(['sort_index' => SORT_ASC])
         ->joinWith('doctors')
         ->all();

      foreach ($doctors as $item) {

         foreach ($item->doctors as $doctor) {
            $doctor->doctor_experience = Doctors::num_decline($doctor->doctor_experience);
         }
      }

      $currentUrl = '/dent/' . $firstLevel . '/';

      $faq = FaqServicesRel::find()
         ->where(['service_id' => $currentService[0]['servise_id']])
         ->joinWith('faq')
         ->all();

      $extraData = [
         'currentService' => $currentService[0], 
         'childrenService' => $childrenService, 
         'servisesWithPrices' => $servisesWithPrices[0],
         'currentUrl' => $currentUrl,
         'doctors' => $doctors,
         'faq' => $faq,
         'csrf' => Yii::$app->request->getCsrfToken()
      ];

      $rawDraft = HcDraft::find()
      ->where(['id' => $currentService[0]->servise_hc_draft_id])
      ->one();

      $draft = $rawDraft->getHtml($extraData);
      $headings = $rawDraft->getTableOfContentsArray();
   
      //   echo '<pre>';
      //   print_r($faq[0]->faq[0]->doctor);
      //   exit;

      return $this->render('servicePage.twig', array(
         'currentService' => $currentService[0],
         'childrenService' => $childrenService,
         'servisesWithPrices' => $servisesWithPrices[0],
         'doctors' => $doctors,
         'draft' => $draft,
         'headings' => $headings,
      )); 
   }

   public function actionSecondLevel($firstLevel, $secondLevel) {
      $currentService = Servises::find()
         ->where(['servises.alias' => $secondLevel, 'servises.is_active' => 1])
         ->with('reviews')
         ->with('faq')
         ->all();

      if (!empty($currentService[0])){
         $this->setSeo($currentService[0]->getSeo());
      } else {
         throw new \yii\web\NotFoundHttpException();
      }

      $childrenService = Servises::find()
         ->where(['parent_id' => $currentService[0]['servise_id'], 'is_active' => 1])
         ->all();

      $servisesWithPrices = Servises::find()
         ->where(['servises.servise_id' => $currentService[0]['servise_id'], 'servises.is_active' => 1])
         ->joinWith('prices')
         ->all(); 

      $mainParent = Servises::find()
         ->where(['alias' => $firstLevel, 'is_active' => 1])
         ->all();

      $allData = DoctorsPageSort::find()
         ->where(['page_type' => 'services', 'page_id' =>  $currentService[0]['servise_id']])
         ->orderBy(['sort_index' => SORT_ASC])
         ->joinWith('doctors')
         ->joinWith('servises')
         ->all();

      $doctors = DoctorsPageSort::find()
      ->where(['page_type' => 'services', 'page_id' => $currentService[0]['servise_id']])
      ->orderBy(['sort_index' => SORT_ASC])
      ->joinWith('doctors')
      ->all();

      foreach ($doctors as $item) {

         foreach ($item->doctors as $doctor) {
            $doctor->doctor_experience = Doctors::num_decline($doctor->doctor_experience);
         }
      }

      $currentUrl = '/dent/' . $firstLevel . '/' . $secondLevel . '/';

      $faq = FaqServicesRel::find()
         ->where(['service_id' => $currentService[0]['servise_id']])
         ->joinWith('faq')
         ->all();

      $breadcrumbs = Servises::getBreadcrumbs([$firstLevel]);

      $extraData = [
         'currentService' => $currentService[0], 
         'childrenService' => $childrenService, 
         'mainParent' => $mainParent[0],
         'servisesWithPrices' => $servisesWithPrices[0],
         'currentUrl' => $currentUrl,
         'doctors' => $doctors,
         'faq' => $faq,
         'csrf' => Yii::$app->request->getCsrfToken()
      ];

      $rawDraft = HcDraft::find()
      ->where(['id' => $currentService[0]->servise_hc_draft_id])
      ->one();

      $draft = $rawDraft->getHtml($extraData);
      $headings = $rawDraft->getTableOfContentsArray();

      // print_r($breadcrumbs);
      // exit;

      return $this->render('servicePage.twig', array(
         'breadcrumbs' => $breadcrumbs,
         'currentService' => $currentService[0],
         'childrenService' => $childrenService,
         'servisesWithPrices' => $servisesWithPrices[0],
         'mainParent' => $mainParent[0],
         'doctors' => $doctors,
         'draft' => $draft,
         'headings' => $headings
      )); 
   }

   public function actionThirdLevel($firstLevel, $secondLevel, $thirdLevel) {
      $currentService = Servises::find()
         ->where(['servises.alias' => $thirdLevel, 'servises.is_active' => 1])
         ->with('reviews')
         ->with('faq')
         ->all();

      if (count($currentService) > 1){
         $tmp = Servises::getCurrentService($currentService, $secondLevel);
         if (!empty($tmp)){
            $currentService[0] = $tmp;
         }
         // print_r($tmp);
         // exit;
      }

      if (!empty($currentService[0])){
         $this->setSeo($currentService[0]->getSeo());
      } else {
         throw new \yii\web\NotFoundHttpException();
      }

      $childrenService = Servises::find()
         ->where(['parent_id' => $currentService[0]['servise_id'], 'is_active' => 1])
         ->all();

      $servisesWithPrices = Servises::find()
         ->where(['servises.servise_id' => $currentService[0]['servise_id'], 'servises.is_active' => 1])
         ->joinWith('prices')
         ->all(); 

      $mainParent = Servises::find()
         ->where(['alias' => $firstLevel, 'is_active' => 1])
         ->all();

      $parent = Servises::find()
         ->where(['alias' => $secondLevel, 'is_active' => 1])
         ->all();

      $doctors = DoctorsPageSort::find()
      ->where(['page_type' => 'services', 'page_id' => $currentService[0]['servise_id']])
      ->orderBy(['sort_index' => SORT_ASC])
      ->joinWith('doctors')
      ->all();

      foreach ($doctors as $item) {

         foreach ($item->doctors as $doctor) {
            $doctor->doctor_experience = Doctors::num_decline($doctor->doctor_experience);
         }
      }

      $currentUrl = '/dent/' . $firstLevel . '/' . $secondLevel . '/' . $thirdLevel . '/';

      $faq = FaqServicesRel::find()
         ->where(['service_id' => $currentService[0]['servise_id']])
         ->joinWith('faq')
         ->all();

      $breadcrumbs = Servises::getBreadcrumbs([$firstLevel, $secondLevel]);

      $extraData = [
         'currentService' => $currentService[0], 
         'childrenService' => $childrenService, 
         'mainParent' => $mainParent[0],
         'servisesWithPrices' => $servisesWithPrices[0],
         'currentUrl' => $currentUrl,
         'doctors' => $doctors,
         'faq' => $faq,
         'csrf' => Yii::$app->request->getCsrfToken()
      ];

      $rawDraft = HcDraft::find()
      ->where(['id' => $currentService[0]->servise_hc_draft_id])
      ->one();

      $draft = $rawDraft->getHtml($extraData);
      $headings = $rawDraft->getTableOfContentsArray();

      //   print_r($servisesWithPrices);
      //   exit;

      return $this->render('servicePage.twig', array(
         'breadcrumbs' => $breadcrumbs,
         'currentService' => $currentService[0],
         'childrenService' => $childrenService,
         'servisesWithPrices' => $servisesWithPrices[0],
         'mainParent' => $mainParent[0],
         'parent' => $parent[0],
         'doctors' => $doctors,
         'draft' => $draft,
         'headings' => $headings
      )); 
   }

   public function actionFourthLevel($firstLevel, $secondLevel, $thirdLevel, $fourthLevel) {
      $currentService = Servises::find()
         ->where(['servises.alias' => $fourthLevel, 'servises.is_active' => 1])
         ->with('reviews')
         ->with('faq')
         ->all();

      if (count($currentService) > 1){
         $tmp = Servises::getCurrentService($currentService, $thirdLevel);
         if (!empty($tmp)){
            $currentService[0] = $tmp;
         }
         // echo $secondLevel;
         // echo '<pre>';
         // print_r($tmp);
         // exit;
      }

      if (!empty($currentService[0])){
         $this->setSeo($currentService[0]->getSeo());
      } else {
         throw new \yii\web\NotFoundHttpException();
      }

      $servisesWithPrices = Servises::find()
         ->where(['servises.servise_id' => $currentService[0]['servise_id'], 'servises.is_active' => 1])
         ->joinWith('prices')
         ->all(); 

      $mainParent = Servises::find()
         ->where(['alias' => $firstLevel, 'is_active' => 1])
         ->all();

      $doctors = DoctorsPageSort::find()
      ->where(['page_type' => 'services', 'page_id' => $currentService[0]['servise_id']])
      ->orderBy(['sort_index' => SORT_ASC])
      ->joinWith('doctors')
      ->all();

      foreach ($doctors as $item) {

         foreach ($item->doctors as $doctor) {
            $doctor->doctor_experience = Doctors::num_decline($doctor->doctor_experience);
         }
      }

      $currentUrl = '/dent/' . $firstLevel . '/' . $secondLevel . '/' . $thirdLevel . '/' . $fourthLevel . '/';

      $faq = FaqServicesRel::find()
         ->where(['service_id' => $currentService[0]['servise_id']])
         ->joinWith('faq')
         ->all();
   
      $breadcrumbs = Servises::getBreadcrumbs([$firstLevel, $secondLevel, $thirdLevel]);

      $extraData = [
         'currentService' => $currentService[0], 
         'mainParent' => $mainParent[0],
         'servisesWithPrices' => $servisesWithPrices[0],
         'currentUrl' => $currentUrl,
         'doctors' => $doctors,
         'faq' => $faq,
         'csrf' => Yii::$app->request->getCsrfToken()
      ];

      $rawDraft = HcDraft::find()
      ->where(['id' => $currentService[0]->servise_hc_draft_id])
      ->one();

      $draft = $rawDraft->getHtml($extraData);
      $headings = $rawDraft->getTableOfContentsArray();

      //   echo '<pre>';
      //   print_r($breadcrumbs);
      //   exit;

      return $this->render('servicePage.twig', array(
         'breadcrumbs' => $breadcrumbs,
         'currentService' => $currentService[0],
         'childrenService' => '',
         'servisesWithPrices' => $servisesWithPrices[0],
         'mainParent' => $mainParent[0],
         'parent' => '',
         'doctors' => $doctors,
         'draft' => $draft,
         'headings' => $headings
      )); 
   }

   public function actionAjaxSaveNewVote() {
      $vote = $_GET['vote'];
      $serviceID = $_GET['service_id'];
      $servise = Servises::find()
         ->where(['servise_id' => $serviceID, 'is_active' => 1])
         ->one();

      $servise->service_page_rating = (double)(($servise->service_page_rating) * ($servise->service_page_votes) + $vote) / (($servise->service_page_votes) + 1);
      $servise->service_page_votes = $servise->service_page_votes + 1;
      $servise->save();

      return json_encode([
         'votes' => $servise->service_page_votes,
         'rating' => $servise->service_page_rating,
      ]);
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