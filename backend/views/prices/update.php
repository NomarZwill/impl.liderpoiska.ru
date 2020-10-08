<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Prices */

$this->title = 'Обновить цену: ' . $model->prices_id;
$this->params['breadcrumbs'][] = ['label' => 'Цены', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prices_id, 'url' => ['view', 'id' => $model->prices_id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="prices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
