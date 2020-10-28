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


class DentController extends MainController
{

   public function actionIndex() {
      // $servises = Servises::find()->all();

      // foreach ($servises as $serviсe) {
      //    $serviсe->head_text = html_entity_decode( $serviсe->head_text, ENT_HTML5);
      //    $serviсe->save();
      // }

      $servises = Servises::find()->asArray()->all();
      // print_r(html_entity_decode($servises[4]['head_text'], ENT_HTML5));
      //   print_r($reviews[1]['review_text']);
      // exit;

      Servises::setFirstLevelChildCount($servises);


      return $this->render('index.twig', array(
         'servises' => $servises
      ));  
   }

   public function actionFirstLevel($firstLevel) {
      $currentService = Servises::find()
         ->where(['alias' => $firstLevel])
         ->all();

      $childrenService = Servises::find()
         ->where(['parent_id' => $currentService[0]['old_id']])
         ->all();

      $servisesWithPrices = Servises::find()
         ->where(['servises.servise_id' => $currentService[0]['servise_id']])
         ->joinWith('prices')
         ->all(); 

      $doctors = Doctors::find()
         ->joinWith('medicalSpecialties')
         ->all();

      $faq = Faq::find()
         ->limit(10)
         ->all();

      //   print_r($servisesWithPrices);
      //   exit;

      return $this->render('servicePage.twig', array(
         'currentService' => $currentService[0],
         'childrenService' => $childrenService,
         'servisesWithPrices' => $servisesWithPrices[0],
         'doctors' => $doctors,
         'faq' => $faq
      )); 
   }

   public function actionSecondLevel($firstLevel, $secondLevel) {
      $currentService = Servises::find()
         ->where(['alias' => $secondLevel])
         ->all();

      $childrenService = Servises::find()
         ->where(['parent_id' => $currentService[0]['old_id']])
         ->all();

      $servisesWithPrices = Servises::find()
         ->where(['servises.servise_id' => $currentService[0]['servise_id']])
         ->joinWith('prices')
         ->all(); 

      $mainParent = Servises::find()
         ->where(['alias' => $firstLevel])
         ->all();

      $doctors = Doctors::find()
         ->joinWith('medicalSpecialties')
         ->all();

      $faq = Faq::find()
         ->limit(10)
         ->all();

      //   print_r($servisesWithPrices);
      //   exit;

      return $this->render('servicePage.twig', array(
         'currentService' => $currentService[0],
         'childrenService' => $childrenService,
         'servisesWithPrices' => $servisesWithPrices[0],
         'mainParent' => $mainParent[0],
         'doctors' => $doctors,
         'faq' => $faq
      )); 
   }

   public function actionThirdLevel($firstLevel, $secondLevel, $thirdLevel) {
      $currentService = Servises::find()
         ->where(['alias' => $thirdLevel])
         ->all();

      $childrenService = Servises::find()
         ->where(['parent_id' => $currentService[0]['old_id']])
         ->all();

      $servisesWithPrices = Servises::find()
         ->where(['servises.servise_id' => $currentService[0]['servise_id']])
         ->joinWith('prices')
         ->all(); 

      $mainParent = Servises::find()
         ->where(['alias' => $firstLevel])
         ->all();

      $parent = Servises::find()
         ->where(['alias' => $secondLevel])
         ->all();

      $doctors = Doctors::find()
         ->joinWith('medicalSpecialties')
         ->all();

      $faq = Faq::find()
         ->limit(10)
         ->all();

      //   print_r($servisesWithPrices);
      //   exit;

      return $this->render('servicePage.twig', array(
         'currentService' => $currentService[0],
         'childrenService' => $childrenService,
         'servisesWithPrices' => $servisesWithPrices[0],
         'mainParent' => $mainParent[0],
         'parent' => $parent[0],
         'doctors' => $doctors,
         'faq' => $faq
      )); 
   }

   public function actionFourthLevel($firstLevel, $secondLevel, $thirdLevel, $fourthLevel) {
      $currentService = Servises::find()
         ->where(['alias' => $fourthLevel])
         ->all();

      $servisesWithPrices = Servises::find()
         ->where(['servises.servise_id' => $currentService[0]['servise_id']])
         ->joinWith('prices')
         ->all(); 

      $mainParent = Servises::find()
         ->where(['alias' => $firstLevel])
         ->all();

      $doctors = Doctors::find()
         ->joinWith('medicalSpecialties')
         ->all();

      $faq = Faq::find()
         ->limit(10)
         ->all();

      //   print_r($servisesWithPrices);
      //   exit;

      return $this->render('servicePage.twig', array(
         'currentService' => $currentService[0],
         'childrenService' => '',
         'servisesWithPrices' => $servisesWithPrices[0],
         'mainParent' => $mainParent[0],
         'parent' => '',
         'doctors' => $doctors,
         'faq' => $faq
      )); 
   }

   public function actionAjaxSaveNewVote() {
      $vote = $_GET['vote'];
      $serviceID = $_GET['service_id'];
      $servise = Servises::find()
         ->where(['servise_id' => $serviceID])
         ->one();

      $servise->service_page_rating = (double)(($servise->service_page_rating) * ($servise->service_page_votes) + $vote) / (($servise->service_page_votes) + 1);
      $servise->service_page_votes = $servise->service_page_votes + 1;
      $servise->save();

      return json_encode([
         'votes' => $servise->service_page_votes,
         'rating' => $servise->service_page_rating,
      ]);
   } 
}