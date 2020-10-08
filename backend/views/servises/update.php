<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Servises */

$this->title = 'Обновить услугу: ' . $model->servise_id;
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->servise_id, 'url' => ['view', 'id' => $model->servise_id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="servises-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
