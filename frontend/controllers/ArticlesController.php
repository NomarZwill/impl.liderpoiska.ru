<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\controllers\MainController;
use backend\models\Articles;
// use backend\models\Prices;
// use backend\models\Doctors;
// use backend\models\DoctorsMedSpec;
// use backend\models\Faq;
// use backend\models\FaqServicesRel;
// use backend\models\DoctorsPageSort;
// use backend\models\SeoSinglePages;
// use common\html_constructor\models\HcDraft;

class ArticlesController extends MainController
{
  public function actionIndex(){

  //   return $this->render('index.twig', array(
  //     'servises' => $servises
  //  ));  

    echo 'тут будут статьи';
  }

  public function actionArticle($article){
    $currentArticle = Articles::find()
      ->where(['alias' => $article])
      ->one();

      return $this->render('article.twig', array(
        'currentArticle' => $currentArticle
     ));  
  }
}