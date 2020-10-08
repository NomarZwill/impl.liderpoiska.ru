<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DoctorsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'doctor_id') ?>

    <?= $form->field($model, 'doctor_title') ?>

    <?= $form->field($model, 'doctor_long_title') ?>

    <?= $form->field($model, 'doctor_description') ?>

    <?= $form->field($model, 'introtext') ?>

    <?php // echo $form->field($model, 'alias') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'doctor_education') ?>

    <?php // echo $form->field($model, 'doctor_image') ?>

    <?php // echo $form->field($model, 'medic_to_filial') ?>

    <?php // echo $form->field($model, 'sort_lab_smail') ?>

    <?php // echo $form->field($model, 'sort_doyche_velle') ?>

    <?php // echo $form->field($model, 'sort_esteticheskaya_stomatologiya_chistie_prudi') ?>

    <?php // echo $form->field($model, 'sort_esteticheskaya_stomatologiya') ?>

    <?php // echo $form->field($model, 'sort_impl') ?>

    <?php // echo $form->field($model, 'sort_centr_implantologii') ?>

    <?php // echo $form->field($model, 'review_to_specials') ?>

    <?php // echo $form->field($model, 'specials_to_medic') ?>

    <?php // echo $form->field($model, 'review_title') ?>

    <?php // echo $form->field($model, 'query_to_service') ?>

    <?php // echo $form->field($model, 'faq_title') ?>

    <?php // echo $form->field($model, 'sort_klinika_dentalgeneva') ?>

    <?php // echo $form->field($model, 'sort_prec_1005') ?>

    <?php // echo $form->field($model, 'sort_prec_1154') ?>

    <?php // echo $form->field($model, 'sort_prec_1459') ?>

    <?php // echo $form->field($model, 'sort_prec_988') ?>

    <?php // echo $form->field($model, 'sort_prec_989') ?>

    <?php // echo $form->field($model, 'sort_prec_990') ?>

    <?php // echo $form->field($model, 'sort_prec_991') ?>

    <?php // echo $form->field($model, 'sort_prec_992') ?>

    <?php // echo $form->field($model, 'sort_prec_994') ?>

    <?php // echo $form->field($model, 'old_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
