<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class OtherController extends Controller
{

  public function actionIndex(){
    // return $this->render('index.twig');
  }

  public function actionAgreement(){

    return 'actionAgreement';
  }

  public function actionContacts(){
    
    return 'actionContacts';
  }

  public function actionClinicContacts($clinic){
    
    return 'actionClinicContacts';
  }

  public function actionPartners(){
    return 'actionPartners';
  }

  public function actionPrices(){

    return 'actionPrices';
  }

  public function actionAbout(){

    return $this->render('about.twig', array(
   ));  
  }

  public function actionSpecialDeals(){

    return 'actionSpecialDeals';
  }

  public function actionSpecialDeal($deal){

    return 'actionSpecialDeal';
  }
  
  public function actionReviews(){

    return 'actionReviews';
  }

  public function actionFaq(){

    return 'actionFaq';
  }

  public function actionLicenses(){

    return 'actionLicenses';
  }

  public function actionWarranty(){

    return 'actionWarranty';
  }
}