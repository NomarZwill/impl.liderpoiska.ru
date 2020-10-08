<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ServisesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servises-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'servise_id') ?>

    <?= $form->field($model, 'servise_title') ?>

    <?= $form->field($model, 'servise_long_title') ?>

    <?= $form->field($model, 'servise_description') ?>

    <?= $form->field($model, 'introtext') ?>

    <?php // echo $form->field($model, 'alias') ?>

    <?php // echo $form->field($model, 'menu_title') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'head_text') ?>

    <?php // echo $form->field($model, 'service_to_price_list') ?>

    <?php // echo $form->field($model, 'price_to_service') ?>

    <?php // echo $form->field($model, 'medic_to_service') ?>

    <?php // echo $form->field($model, 'review_to_service') ?>

    <?php // echo $form->field($model, 'query_to_service') ?>

    <?php // echo $form->field($model, 'padej_predl') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'price_title') ?>

    <?php // echo $form->field($model, 'review_title') ?>

    <?php // echo $form->field($model, 'faq_title') ?>

    <?php // echo $form->field($model, 'medic_title') ?>

    <?php // echo $form->field($model, 'index_id') ?>

    <?php // echo $form->field($model, 'servise_listing_id') ?>

    <?php // echo $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'old_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
