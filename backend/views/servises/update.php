<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Servises */

$this->title = 'Обновить услугу: ' . $model->menu_title;
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить ' . $model->menu_title;
?>
<div class="servises-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
