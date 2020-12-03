<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use backend\models\ImageGalleries;

/* @var $this yii\web\View */
/* @var $model backend\models\Clinics */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clinics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clinic_title')->textInput() ?>

    <?= $form->field($model, 'clinic_long_title')->textInput() ?>

    <?= $form->field($model, 'clinic_description')->textInput() ?>
    
    <?= $form->field($model, 'keywords')->textInput() ?>
    
    <?= $form->field($model, 'card_title')->textInput() ?>

    <?= $form->field($model, 'h1_title')->textInput() ?>

    <?= $form->field($model, 'breadcrumbs_title')->textInput() ?>

    <?php if (empty($isCreate)){ ?>

        <?= $form->field($model, 'alias')->textInput() ?>

    <?php } ?>

    <?= $form->field($model, 'clinic_sort')->textInput() ?>
    
    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?php
        $initialPreview = [];
        $initialPreviewConfig = [];
        $path = 'images/uploaded/clinics/'. $model->clinic_id . '/';
        if (is_dir($path)) {
            $images = ImageGalleries::find()->where(['parent_type' => 'clinics', 'parent_id' => $model->clinic_id])->orderBy(['img_sort' => SORT_ASC])->all();
            foreach ($images as $image) {
                $initialPreview[] = Html::img(Url::to("@web/$image->filepath"), ['class'=>'file-preview-image']);
                $initialPreviewConfig[] = ['caption' => '', 'width' => "120px", 'url' => "/clinics/" . $model->clinic_id . "/delete-gallery-image/" . $image->id . '/', 'key' => $image->id];
            }
        }
        ?>

    <?php if (empty($isCreate)){ ?>

        <?=  $form->field($model, 'cinic_gallery_images[]')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
                'multiple' => true,
            ],
            'pluginOptions' => [
                'initialPreview'=>$initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig,
                'overwriteInitial'=>false,
            ],
            'pluginEvents' => [
                'filesorted' => 'function(event, params) {
                    console.log( params );
                    $.ajax({
                        url: "/clinics/ajax-dragfile/",
                        type: "post",
                        data: { previewId: params.stack[params.newIndex].key, oldIndex: params.oldIndex, newIndex: params.newIndex, stack: params.stack},
                    }).done(function( log ) {
                         console.log( "Data Saved: " + log );
                    });
                }',
            ],
        ])?>

    <?php } ?>

    <?= $form->field($model, 'clinic_address')->textInput() ?>

    <?= $form->field($model, 'clinic_address_short')->textInput() ?>

    <?= $form->field($model, 'clinic_opening_weekdays')->textInput() ?>

    <?= $form->field($model, 'clinic_opening_sat')->textInput() ?>

    <?= $form->field($model, 'clinic_opening_sun')->textInput() ?>

    <?= $form->field($model, 'clinic_phone')->textInput() ?>

    <?= $form->field($model, 'main_phone')->textInput() ?>

    <?= $form->field($model, 'clinic_whatsapp')->textInput() ?>

    <?= $form->field($model, 'clinic_mail')->textInput() ?>

    <!-- <?= $form->field($model, 'clinic_opening_hours')->textInput() ?> -->

    <!-- <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'clinic_map')->textInput() ?> -->

    <!-- <?= $form->field($model, 'review_to_filial')->textInput() ?> -->

    <!-- <?= $form->field($model, 'review_title')->textInput() ?> -->

    <!-- <?= $form->field($model, 'bottom_text')->textInput() ?> -->

    <!-- <?= $form->field($model, 'old_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
