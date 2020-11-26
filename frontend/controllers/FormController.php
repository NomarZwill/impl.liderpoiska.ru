<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class FormController extends Controller
{

  public function actionRecall(){
    if($_POST['type'] == 'recall'){

      return json_encode([
        'error' => 0,
        'name' => isset($_POST['name']) ? $_POST['name'] : '',
        'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
      ]);
    } else {

      return json_encode([
        'error' => 0,
        'allData' => 'not recall'
      ]);
    }
  }

  public function actionReception(){
    if($_POST['type'] == 'reception'){

      return json_encode([
        'error' => 0,
        'name' => isset($_POST['name']) ? $_POST['name'] : '',
        'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
      ]);
    } else {

      return json_encode([
        'error' => 0,
        'allData' => 'not reception'
      ]);
    }
  }

  public function actionReview(){
    if($_POST['type'] == 'review'){

      return json_encode([
        'error' => 0,
        'name' => isset($_POST['name']) ? $_POST['name'] : '',
        'age' => isset($_POST['age']) ? $_POST['age'] : '',
      ]);
    } else {

      return json_encode([
        'error' => 0,
        'allData' => 'not review'
      ]);
    }
  
  }
  public function actionFaq(){
    if($_POST['type'] == 'faq'){

      return json_encode([
        'error' => 0,
        'name' => isset($_POST['name']) ? $_POST['name'] : '',
        'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
      ]);
    } else {

      return json_encode([
        'error' => 0,
        'allData' => 'not faq'
      ]);
    }
  }
}