<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OurWorks */

$this->title = 'Обновить: ' . $model->h1;
$this->params['breadcrumbs'][] = ['label' => 'Наши работы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->h1, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="our-works-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'isCreate' => false,
    ]) ?>

</div>
