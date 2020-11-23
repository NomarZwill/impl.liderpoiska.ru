<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Servises;
use backend\models\MedicalSpecialties;
use backend\models\Doctors;
use backend\models\Clinics;
use backend\models\ReviewServiceRel;
use backend\models\ReviewSpecRel;
use backend\models\ReviewDoctorsRel;
use backend\models\ReviewClinicRel;


/* @var $this yii\web\View */
/* @var $model backend\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviews-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author_age')->textInput() ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?php
        $allServicesData = Servises::getArrayToSelect2();
        $activeRecviewServices = ReviewServiceRel::getReviewServiceIDs($model->review_id);
    ?>

    <?= $form->field($model, 'review_service_rel')->widget(Select2::classname(), [
        'data' => $allServicesData,
        //'maintainOrder' => true,
        'options' => ['value' => $activeRecviewServices, 'placeholder' => 'Выберите услуги', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);?>

    <?php
        $allSpecialtiesData = MedicalSpecialties::getArrayToSelect2();
        $activeRecviewSpec = ReviewSpecRel::getReviewSpecIDs($model->review_id);
    ?>

    <?= $form->field($model, 'review_spec_rel')->widget(Select2::classname(), [
        'data' => $allSpecialtiesData,
        //'maintainOrder' => true,
        'options' => ['value' => $activeRecviewSpec, 'placeholder' => 'Выберите специальности', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);?>

    <?php
        $allDoctorsData = Doctors::getArrayToSelect2();
        $activeRecviewDoctors = ReviewDoctorsRel::getReviewDoctorIDs($model->review_id);
    ?>

    <?= $form->field($model, 'review_doctor_rel')->widget(Select2::classname(), [
        'data' => $allDoctorsData,
        //'maintainOrder' => true,
        'options' => ['value' => $activeRecviewDoctors, 'placeholder' => 'Выберите врачей', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);?>

    <?php
        $allClinicsData = Clinics::getArrayToSelect2();
        $activeRecviewClinics = ReviewClinicRel::getReviewClinicsIDs($model->review_id);
    ?>

    <?= $form->field($model, 'review_clinic_rel')->widget(Select2::classname(), [
        'data' => $allClinicsData,
        //'maintainOrder' => true,
        'options' => ['value' => $activeRecviewClinics, 'placeholder' => 'Выберите клиники', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);?>

    <?= $form->field($model, 'review_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <!-- <?= $form->field($model, 'review_title')->textInput() ?> -->

    <!-- <?= $form->field($model, 'old_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
