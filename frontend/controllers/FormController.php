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

      $mailInfo = [
        'name' => isset($_POST['name']) ? $_POST['name'] : '',
        'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
      ];

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

      $mailInfo = [
        'name' => isset($_POST['name']) ? $_POST['name'] : '',
        'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
        'clinic' => isset($_POST['clinic']) ? $_POST['clinic'] : '',
        'date' => isset($_POST['date']) ? $_POST['date'] : '',
        'email' => isset($_POST['email']) ? $_POST['email'] : '',
      ];

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

      $mailInfo = [
        'name' => isset($_POST['name']) ? $_POST['name'] : '',
        'age' => isset($_POST['phone']) ? $_POST['phone'] : '',
        'review' => isset($_POST['review']) ? $_POST['review'] : '',
      ];

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

      $mailInfo = [
        'name' => isset($_POST['name']) ? $_POST['name'] : '',
        'question' => isset($_POST['question']) ? $_POST['question'] : '',
        'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
        'email' => isset($_POST['email']) ? $_POST['email'] : '',
      ];

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