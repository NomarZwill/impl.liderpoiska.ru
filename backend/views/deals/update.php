<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Deals */

$this->title = 'Обновить спецпредложение: ' . $model->deals_id;
$this->params['breadcrumbs'][] = ['label' => 'Спецпредложения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->deals_id, 'url' => ['view', 'id' => $model->deals_id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="deals-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
