<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClinicsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clinics-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'clinic_id') ?>

    <?= $form->field($model, 'clinic_title') ?>

    <?= $form->field($model, 'clinic_long_title') ?>

    <?= $form->field($model, 'clinic_description') ?>

    <?= $form->field($model, 'alias') ?>

    <?php // echo $form->field($model, 'card_title') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'clinic_address') ?>

    <?php // echo $form->field($model, 'clinic_address_short') ?>

    <?php // echo $form->field($model, 'clinic_phone') ?>

    <?php // echo $form->field($model, 'clinic_whatsapp') ?>

    <?php // echo $form->field($model, 'clinic_mail') ?>

    <?php // echo $form->field($model, 'clinic_site') ?>

    <?php // echo $form->field($model, 'clinic_coords') ?>

    <?php // echo $form->field($model, 'clinic_latitude') ?>

    <?php // echo $form->field($model, 'clinic_longitude') ?>

    <?php // echo $form->field($model, 'clinic_opening_hours') ?>

    <?php // echo $form->field($model, 'clinic_map') ?>

    <?php // echo $form->field($model, 'main_phone') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'review_to_filial') ?>

    <?php // echo $form->field($model, 'review_title') ?>

    <?php // echo $form->field($model, 'bottom_text') ?>

    <?php // echo $form->field($model, 'old_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
