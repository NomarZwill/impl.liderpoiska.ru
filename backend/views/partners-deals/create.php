<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PartnersDeals */

$this->title = 'Создать подарок';
$this->params['breadcrumbs'][] = ['label' => 'Подарки от партнёров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partners-deals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'isCreate' => true,
    ]) ?>

</div>
