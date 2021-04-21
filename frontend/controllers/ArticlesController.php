<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\controllers\MainController;
use backend\models\Articles;
use backend\models\Doctors;
use backend\models\ArticlesFaqRel;
use backend\models\DoctorsPageSort;
use backend\models\SeoSinglePages;
use common\html_constructor\models\HcDraft;

class ArticlesController extends MainController
{
  public function actionIndex(){
    $seo = SeoSinglePages::findOne(13);

    $this->setSeo([
       'title' => $seo->title,
       'desc' => $seo->description,
       'kw' => $seo->keywords,
    ]);

    return $this->render('index.twig');  
  }

  public function actionArticle($article){
    $currentArticle = Articles::find()
      ->where(['alias' => $article])
      ->with('prices')
      ->with('faq')
      ->one();

    $doctors = DoctorsPageSort::find()
    ->where(['page_type' => 'articles', 'page_id' => $currentArticle['id']])
    ->orderBy(['sort_index' => SORT_ASC])
    ->joinWith('doctors')
    ->all();

    foreach ($doctors as $item) {

      foreach ($item->doctors as $doctor) {
         $doctor->doctor_experience = Doctors::num_decline($doctor->doctor_experience);
      }
    }

    if (!empty($currentArticle)){
      $this->setSeo($currentArticle->getSeo());
    } else {
        throw new \yii\web\NotFoundHttpException();
    }
    
    $extraData = [
      'currentService' => $currentArticle,
      'doctors' => $doctors,
      // 'csrf' => Yii::$app->request->getCsrfToken()
    ];

    $rawDraft = HcDraft::find()
    ->where(['id' => $currentArticle->article_hc_draft_id])
    ->one();

    $draft = $rawDraft->getHtml($extraData);
    $headings = $rawDraft->getTableOfContentsArray();

    // echo '<pre>';
    // print_r($currentArticle);
    // exit;

    return $this->render('article.twig', array(
      'currentArticle' => $currentArticle,
      'draft' => $draft,
      'headings' => $headings,
      'microdata' => Articles::getMicroData($currentArticle),
    ));  
  }

  public function actionAjaxGetMoreArticles(){
    $previousArticleCount = $_GET['previousArticleCount'];
    $articles = Articles::find()
      ->offset($previousArticleCount)
      ->limit(6)
      ->all();
    $isListEnd = (count($articles) < 5) ? true : false;

    return json_encode([
      'listing' => $this->renderPartial('/components/article_preview.twig', array(
        'articles' => $articles,
      )),
      'isListEnd' => $isListEnd
    ]);
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