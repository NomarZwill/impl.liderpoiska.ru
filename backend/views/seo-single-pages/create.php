<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SeoSinglePages */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'SEO для общих страниц', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-single-pages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
