<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalSpecialtiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medical-specialties-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'specialty_id') ?>

    <?= $form->field($model, 'specialty_title') ?>

    <?= $form->field($model, 'specialty_long_title') ?>

    <?= $form->field($model, 'specialty_description') ?>

    <?= $form->field($model, 'introtext') ?>

    <?php // echo $form->field($model, 'alias') ?>

    <?php // echo $form->field($model, 'menu_title') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'speciality_review') ?>

    <?php // echo $form->field($model, 'head_text') ?>

    <?php // echo $form->field($model, 'price_title') ?>

    <?php // echo $form->field($model, 'review_title') ?>

    <?php // echo $form->field($model, 'faq_title') ?>

    <?php // echo $form->field($model, 'medic_to_special') ?>

    <?php // echo $form->field($model, 'query_to_service') ?>

    <?php // echo $form->field($model, 'price_to_service') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'old_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
