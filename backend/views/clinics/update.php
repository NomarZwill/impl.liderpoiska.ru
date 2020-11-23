<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Clinics */

$this->title = 'Обновить клинику : ' . $model->card_title;
$this->params['breadcrumbs'][] = ['label' => 'Клиники', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Обновить $model->card_title";
?>
<div class="clinics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
