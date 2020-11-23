<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ratings */

$this->title = 'Обновить рейтинг: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Рейтинги', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить' . $model->name;
?>
<div class="ratings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
