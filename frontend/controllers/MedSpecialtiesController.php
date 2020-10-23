<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\controllers\MainController;
use backend\models\Doctors;
use backend\models\MedicalSpecialties;
use backend\models\DoctorsMedSpec;

class MedSpecialtiesController extends MainController
{
  public function actionSpecialityName($specAlias){
    $medicalSpecialtiesAll = MedicalSpecialties::find()->all(); 
    // $medicalSpecialties = MedicalSpecialties::find()
    //   ->where(['medical_specialties.alias' => $specID])
    //   ->joinWith('doctors')
    //   ->all(); 

    $activeSpec = MedicalSpecialties::find()->where(['alias' => $specAlias])->one();

    // $doctors = Doctors::find()
    //   ->joinWith('medicalSpecialties')
    //   ->where(['doctors_med_spec.specialty_id' => $activeSpec->specialty_id])
    //   ->limit(8)
    //   ->all();

    // print_r($doctors);
    // exit;
      
    return $this->render('index.twig', array(
      // 'doctors' => $doctors,
      'activeSpec' => $activeSpec,
      'medicalSpecialtiesAll' => $medicalSpecialtiesAll
    ));
  }
}