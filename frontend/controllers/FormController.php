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

      $msg = $this->renderPartial('/emails/callback.twig', array(
        'mailInfo' => $mailInfo,
      ));

      $message = Yii::$app->mailer->compose()
        ->setFrom(['impl-stom@yandex.ru' => 'Клиника ЦЭС'])
        ->setTo(['artm@liderpoiska.ru', 'martynov@liderpoiska.ru', 'knyazkova@liderpoiska.ru'])
        ->setSubject('Заказ обратного звонка')
        ->setCharset('utf-8')
        ->setHtmlBody($msg);

      $message->send();

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

      $msg = $this->renderPartial('/emails/reception.twig', array(
        'mailInfo' => $mailInfo,
      ));

      $message = Yii::$app->mailer->compose()
        ->setFrom(['impl-stom@yandex.ru' => 'Клиника ЦЭС'])
        ->setTo(['artm@liderpoiska.ru', 'martynov@liderpoiska.ru', 'knyazkova@liderpoiska.ru'])
        ->setSubject('Запись на приём')
        ->setCharset('utf-8')
        ->setHtmlBody($msg);

      $message->send();

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
        'age' => isset($_POST['age']) ? $_POST['age'] : '',
        'review' => isset($_POST['review']) ? $_POST['review'] : '',
      ];

      $msg = $this->renderPartial('/emails/review.twig', array(
        'mailInfo' => $mailInfo,
      ));

      $message = Yii::$app->mailer->compose()
        ->setFrom(['impl-stom@yandex.ru' => 'Клиника ЦЭС'])
        ->setTo(['artm@liderpoiska.ru', 'martynov@liderpoiska.ru', 'knyazkova@liderpoiska.ru'])
        ->setSubject('Отзыв с сайта')
        ->setCharset('utf-8')
        ->setHtmlBody($msg);

      $message->send();

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

      $msg = $this->renderPartial('/emails/faq.twig', array(
        'mailInfo' => $mailInfo,
      ));

      $message = Yii::$app->mailer->compose()
        ->setFrom(['impl-stom@yandex.ru' => 'Клиника ЦЭС'])
        ->setTo(['artm@liderpoiska.ru', 'martynov@liderpoiska.ru', 'knyazkova@liderpoiska.ru'])
        ->setSubject('Вопрос с сайта')
        ->setCharset('utf-8')
        ->setHtmlBody($msg);

      $message->send();

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