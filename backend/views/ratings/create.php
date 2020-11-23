<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ratings */

$this->title = 'Добавить рейтинг';
$this->params['breadcrumbs'][] = ['label' => 'Рейтинги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ratings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'isCreate' => true,
    ]) ?>

</div>
