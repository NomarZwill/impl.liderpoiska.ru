<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Servises;
use backend\models\Doctors;
use backend\models\FaqServicesRel;

/* @var $this yii\web\View */
/* @var $model backend\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (empty($isCreate)){ ?>

        <?= $form->field($model, 'alias')->textInput() ?>

    <?php } ?>

    <?= $form->field($model, 'faq_title')->textInput() ?>

    <?= $form->field($model, 'patient_name')->textInput() ?>

    <?= $form->field($model, 'patient_mail')->textInput() ?>

    <?= $form->field($model, 'patient_phone')->textInput() ?>

    <?= $form->field($model, 'faq_sort')->textInput() ?>

    <?php
        $allServicesData = Servises::getArrayToSelect2();
        $activeFaqServices = FaqServicesRel::getFaqServiceIDs($model->faq_id);
    ?>

    <?= $form->field($model, 'faq_service_rel')->widget(Select2::classname(), [
        'data' => $allServicesData,
        //'maintainOrder' => true,
        'options' => ['value' => $activeFaqServices, 'placeholder' => 'Выберите связанные услуги', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);?>

    <?= $form->field($model, 'faq_query')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'faq_answer')->textarea(['rows' => 4]) ?>

    <?php
        $allAnsweringDoctorsData = Doctors::getArrayToSelect2(true);
        $activeAnsweringDoctor = $model->doctor_for_answer_id;
    ?>

    <?= $form->field($model, 'doctor_for_answer_id')->widget(Select2::classname(), [
        'data' => $allAnsweringDoctorsData,
        //'maintainOrder' => true,
        'options' => ['value' => $activeAnsweringDoctor, 'placeholder' => 'Выберите врача', 'multiple' => false],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);?>

    <!-- <?= $form->field($model, 'faq_title')->textInput() ?> -->

    <!-- <?= $form->field($model, 'keywords')->textInput() ?> -->

    <!-- <?= $form->field($model, 'old_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
