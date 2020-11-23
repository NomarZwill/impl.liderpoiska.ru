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

    <?= $form->field($model, 'name')->textInput() ?>

    <?php
        $initialPreview = [];
        $initialPreviewConfig = [];
        $path = 'images/uploaded/ratings/'. $model->id . '/';
        if (is_dir($path)) {
            $images =  FileHelper::findFiles($path);

            if (!empty($model->icon)) {
                $initialPreview[] = Html::img(Url::to('@web/' . $path .  $model->icon), ['class'=>'file-preview-image']);
            }

            $initialPreviewConfig[] = ['caption' => '', 'width' => "120px", 'url' => "/ratings/" . $model->id . "/delete-icon/", 'key' => ''];
        }
    ?>

    <?php if (empty($isCreate)){ ?>

        <?=  $form->field($model, 'icon_img')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>$initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig,
                'overwriteInitial'=>false,
                'maxFileCount' => 1,
            ]
        ])?>

    <?php } ?>

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
