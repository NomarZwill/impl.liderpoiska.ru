<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Clinics;
use kartik\file\FileInput;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Ratings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ratings-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'name')->textInput() ?> -->

    <?php
        $allRatingsData = [
            'Yell' => 'Yell',
            'Flamp' => 'Flamp',
            'Google' => 'Google',
            'Yandex' => 'Yandex',
            'Zoon' => 'Zoon',
            'ПроДокторов' => 'ПроДокторов',
        ];
        $activeRating = $model->rating_name;
    ?>

    <?= $form->field($model, 'rating_name')->widget(Select2::classname(), [
        'data' => $allRatingsData,
        //'maintainOrder' => true,
        'options' => ['value' => $activeRating, 'placeholder' => 'Выберите рейтинг', 'multiple' => false],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);?>

    <!-- <?= $form->field($model, 'icon')->textInput() ?> -->

    <?= $form->field($model, 'link_to_agregator')->textInput() ?>

    <?= $form->field($model, 'average_rating')->textInput() ?>

    <?php
        $allClinicsData = Clinics::getArrayToSelect2();
        $activeratingClinics = $model->clinic_id;
    ?>

    <?= $form->field($model, 'clinic_id')->widget(Select2::classname(), [
        'data' => $allClinicsData,
        //'maintainOrder' => true,
        'options' => ['value' => $activeratingClinics, 'placeholder' => 'Выберите клиники', 'multiple' => false],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <!-- <?= $form->field($model, 'clinic_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
