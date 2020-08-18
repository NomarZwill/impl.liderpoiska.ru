<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Servises;
use backend\models\Doctors;
use backend\models\DoctorsMedSpec;


class DentController extends Controller
{

   public function actionIndex(){
      $servises = Servises::find()->asArray()->all();


      //   print_r($servises);
      //   print_r($reviews[1]['review_text']);
      //   exit;

      return $this->render('index.twig', array(
         'servises' => $servises
      ));  
   }
   public function actionFirstLevel($firstLevel){

      $currentService = Servises::find()
      ->where(['alias' => $firstLevel])
      ->asArray()
      ->all();

      $childrenService = Servises::find()
      ->where(['parent_id' => $currentService[0]['old_id']])
      ->asArray()
      ->all();

      $doctors = Doctors::find()
      ->joinWith('medicalSpecialties')
      ->asArray()
      ->all();

      //   print_r($childrenService);
      //   exit;

      return $this->render('servicePage.twig', array(
         'currentService' => $currentService[0],
         'childrenService' => $childrenService,
         'doctors' => $doctors
      )); 
   }
   public function actionSecondLevel($firstLevel, $secondLevel){
      return 'actionSecondLevel';
   }
   public function actionThirdLevel($firstLevel, $secondLevel, $thirdLevel){
      return 'actionThirdLevel';
   }
   public function actionFourthLevel($firstLevel, $secondLevel, $thirdLevel, $fourthLevel){
      return 'actionFourthLevel';
   }
 



}