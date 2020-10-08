<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Doctors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doctor_title')->textInput() ?>

    <?= $form->field($model, 'doctor_long_title')->textInput() ?>

    <?= $form->field($model, 'doctor_description')->textInput() ?>

    <!-- <?= $form->field($model, 'introtext')->textInput() ?> -->

    <?= $form->field($model, 'alias')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'doctor_education')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'doctor_image')->textInput() ?>

    <?= $form->field($model, 'medic_to_filial')->textInput() ?>

    <!-- <?= $form->field($model, 'sort_lab_smail')->textInput() ?>

    <?= $form->field($model, 'sort_doyche_velle')->textInput() ?>

    <?= $form->field($model, 'sort_esteticheskaya_stomatologiya_chistie_prudi')->textInput() ?>

    <?= $form->field($model, 'sort_esteticheskaya_stomatologiya')->textInput() ?>

    <?= $form->field($model, 'sort_impl')->textInput() ?>

    <?= $form->field($model, 'sort_centr_implantologii')->textInput() ?> -->

    <?= $form->field($model, 'review_to_specials')->textInput() ?>

    <?= $form->field($model, 'specials_to_medic')->textInput() ?>

    <?= $form->field($model, 'review_title')->textInput() ?>

    <?= $form->field($model, 'query_to_service')->textInput() ?>

    <?= $form->field($model, 'faq_title')->textInput() ?>

    <!-- <?= $form->field($model, 'sort_klinika_dentalgeneva')->textInput() ?>

    <?= $form->field($model, 'sort_prec_1005')->textInput() ?>

    <?= $form->field($model, 'sort_prec_1154')->textInput() ?>

    <?= $form->field($model, 'sort_prec_1459')->textInput() ?>

    <?= $form->field($model, 'sort_prec_988')->textInput() ?>

    <?= $form->field($model, 'sort_prec_989')->textInput() ?>

    <?= $form->field($model, 'sort_prec_990')->textInput() ?>

    <?= $form->field($model, 'sort_prec_991')->textInput() ?>

    <?= $form->field($model, 'sort_prec_992')->textInput() ?>

    <?= $form->field($model, 'sort_prec_994')->textInput() ?>

    <?= $form->field($model, 'old_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
