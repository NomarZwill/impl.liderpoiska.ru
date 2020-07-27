<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class DentController extends Controller
{

  public function actionIndex(){
     return 'actionIndex';
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