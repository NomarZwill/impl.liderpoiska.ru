<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Clinics;
use backend\models\Doctors;
use common\models\api\Maps;

class OtherController extends Controller
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
    $doctors = Doctors::find()->asArray()->all();      
    return $this->render('clinicContacts.twig', array(
      'clinic' => $currentClinic,
      'doctors' => $doctors
    ));
  }

  public function actionPartners(){

    return $this->render('partners.twig');
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