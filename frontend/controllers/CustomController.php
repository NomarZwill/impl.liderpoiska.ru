<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Prices;
// use yii\helpers\ArrayHelper;

class CustomController extends Controller
{

  public function actionIndex()
  {
    // return $this->render('index.php');
  }

  public function actionCustom()
  {
    exit;
    echo "ID NAME PRICE LINK</br>";
    foreach (Prices::find()->all() as $price){
      echo "$price->prices_id $price->prices_name $price->price</br>";
    }
    // echo "<pre>";
    // print_r($randomizer->getAllParams());
    echo "конец";
  }
}