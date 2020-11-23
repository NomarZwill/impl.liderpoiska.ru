<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DealsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deals-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'deals_id') ?>

    <?= $form->field($model, 'deals_title') ?>

    <?= $form->field($model, 'deals_long_title') ?>

    <?= $form->field($model, 'deals_description') ?>

    <?= $form->field($model, 'deals_index_description') ?>

    <?php // echo $form->field($model, 'alias') ?>

    <?php // echo $form->field($model, 'deals_image_front') ?>

    <?php // echo $form->field($model, 'deals_image_back') ?>

    <?php // echo $form->field($model, 'deals_content') ?>

    <?php // echo $form->field($model, 'old_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
