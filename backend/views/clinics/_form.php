<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Clinics */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clinics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clinic_title')->textInput() ?>

    <?= $form->field($model, 'clinic_long_title')->textInput() ?>

    <?= $form->field($model, 'clinic_description')->textInput() ?>

    <?= $form->field($model, 'alias')->textInput() ?>

    <?= $form->field($model, 'menu_title')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'clinic_address')->textInput() ?>

    <?= $form->field($model, 'clinic_phone')->textInput() ?>

    <?= $form->field($model, 'clinic_opening_hours')->textInput() ?>

    <?= $form->field($model, 'clinic_map')->textInput() ?>

    <?= $form->field($model, 'main_phone')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'review_to_filial')->textInput() ?>

    <?= $form->field($model, 'review_title')->textInput() ?>

    <?= $form->field($model, 'bottom_text')->textInput() ?>

    <!-- <?= $form->field($model, 'old_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
