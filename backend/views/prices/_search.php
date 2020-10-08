<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PricesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prices-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'prices_id') ?>

    <?= $form->field($model, 'prices_name') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'price_hide') ?>

    <?= $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'alias') ?>

    <?php // echo $form->field($model, 'old_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
