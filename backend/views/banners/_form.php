<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\file\FileInput;
use backend\models\Clinics;
use backend\models\BannersAndClinics;
use backend\models\Servises;
use backend\models\BannersAndServices;


/* @var $this yii\web\View */
/* @var $model backend\models\Banners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banners-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'banner_csrf')->hiddenInput(['name' => Yii::$app->request->csrfParam, 'value' => Yii::$app->request->getCsrfToken()]) ?>

    <?= $form->field($model, 'header')->textInput() ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'button_label')->textInput() ?>

    <?= $form->field($model, 'link_to_deal')->textInput() ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?php if (empty($isCreate)){ ?>

        <?php
            $initialPreview = [];
            $initialPreviewConfig = [];
            $path = 'images/uploaded/banners/'. $model->id . '/';
            if (is_dir($path)) {
                $images =  FileHelper::findFiles($path);

                if (!empty($model->image)) {
                    $initialPreview[] = Html::img(Url::to('@web/' . $path .  $model->image), ['class'=>'file-preview-image']);
                }

                $initialPreviewConfig[] = ['caption' => '', 'width' => "120px", 'url' => "/banners/" . $model->id . "/delete-image/", 'key' => ''];
            }
        ?>

        <?=  $form->field($model, 'banner_image_load')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>$initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig,
                'overwriteInitial'=>false,
                'maxFileCount' => 1,
            ]
        ])?>

        <?php
            $allClinicsData = Clinics::getArrayToSelect2();
            $activeBannersClinics = BannersAndClinics::getBannersClinicIDs($model->id);
        ?>
        
        <?= $form->field($model, 'banner_clinic_rel')->widget(Select2::classname(), [
            'data' => $allClinicsData,
            //'maintainOrder' => true,
            'options' => ['value' => $activeBannersClinics, 'placeholder' => 'Выберите клиники', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);?>

        <?php
            $allServicesData = Servises::getServicesRootsArrayToSelect2();
            $activeBannersServices = BannersAndServices::getBannersServiceIDs($model->id);
        ?>

        <?= $form->field($model, 'banner_service_rel')->widget(Select2::classname(), [
            'data' => $allServicesData,
            //'maintainOrder' => true,
            'options' => ['value' => $activeBannersServices, 'placeholder' => 'Выберите услуги', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);?>

    <?php } ?>

    <!-- <?= $form->field($model, 'image')->textarea(['rows' => 6]) ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
