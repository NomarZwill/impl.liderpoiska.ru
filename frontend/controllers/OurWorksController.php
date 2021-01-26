<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use frontend\controllers\MainController;
use backend\models\SeoSinglePages;
use backend\models\OurWorks;
use backend\models\Servises;
use common\html_constructor\models\HcDraft;

class OurWorksController extends MainController
{
  public function actionIndex(){
    $seo = SeoSinglePages::findOne(14);
    $works = OurWorks::find()->all();
    $allDraftID = ArrayHelper::getColumn($works, 'draft_id');
    $allServiceID = ArrayHelper::getColumn($works, 'service_id');

    $services = Servises::find()
      ->where(['servise_id' => $allServiceID])
      ->with('reviews')
      ->asArray()
      ->all();
    $reviews = [];

    foreach ($services as $service) {
      $reviews = ArrayHelper::merge($reviews, $service['reviews']);
    }

    $drafts = HcDraft::find()
      ->where(['id' => $allDraftID])
      ->all();
    
    $finalRenderedDrafts = '';
    
    foreach ($drafts as $draft) {
      $finalRenderedDrafts .= $draft->getHtml();
    }
    // echo '<pre>';
    // print_r($reviews);
    // echo '</pre>';
    // exit;

    $gallery = $this->renderPartial('work.twig', array(
      'draft' => $finalRenderedDrafts
    ));

    $this->setSeo([
       'title' => $seo->title,
       'desc' => $seo->description,
       'kw' => $seo->keywords,
    ]);

    return $this->render('index.twig', array(
      'works' => $works,
      'gallery' => $gallery,
      'reviews' => $reviews,
      'allWorkFlag' => true,
    ));  
  }

  public function actionWorkPage($workName){
    $seo = SeoSinglePages::findOne(14);
    $works = OurWorks::find()->all();
    $activeWork = OurWorks::find()->where(['alias' => $workName])->one();

    if (!empty($activeWork)){
      $this->setSeo($activeWork->getSeo());
    } else {
      throw new \yii\web\NotFoundHttpException();
    }

    $service = Servises::find()
    ->where(['servise_id' => $activeWork->service_id])
    ->with('reviews')
    ->asArray()
    ->one();

    $reviews = $service['reviews'];

    // echo '<pre>';
    // print_r($reviews);
    // echo '</pre>';
    // exit;

    $draft = HcDraft::find()
    ->where(['id' => $activeWork->draft_id])
    ->one()
    ->getHtml();

    $gallery = $this->renderPartial('work.twig', array(
      'draft' => $draft
    ));

    return $this->render('index.twig', array(
      'works' => $works,
      'activeWork' => $activeWork,
      'gallery' => $gallery,
      'reviews' => $reviews,
      'service' => $service,
    ));   
  }


  public function setSeo($seo){

    if (!empty($seo)) {
      $this->view->title = $seo['title'];
      $this->view->params['desc'] = $seo['desc'];
      $this->view->params['kw'] = $seo['kw'];
    } else {
      $this->view->title = '';
      $this->view->params['desc'] = '';
      $this->view->params['kw'] = '';
    }
  }
}