<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Servises;


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
      return 'actionFirstLevel';
   }
   public function actionSecondLevel($firstLevel, $secondLevel){
      return 'actionSecondLevel';
   }
   public function actionThirdLevel($firstLevel, $secondLevel, $thirdLevel){
      return 'actionThirdLevel';
   }
 



}