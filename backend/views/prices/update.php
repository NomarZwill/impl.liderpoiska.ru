<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Prices */

$this->title = 'Обновить цену: ' . substr($model->prices_name, 0, 50) . '...';
$this->params['breadcrumbs'][] = ['label' => 'Цены', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Обновить $model->prices_name";
?>
<div class="prices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
