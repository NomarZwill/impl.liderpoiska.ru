<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Deals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deals-form">
    
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'deals_title')->textInput() ?>

    <?= $form->field($model, 'deals_long_title')->textInput() ?>

    <?= $form->field($model, 'deals_description')->textInput() ?>
    
    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'deals_index_description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'h1_title')->textInput() ?>

    <?= $form->field($model, 'breadcrumbs_title')->textInput() ?>

    <?php if (empty($isCreate)){ ?>

        <?= $form->field($model, 'alias')->textInput() ?>

    <?php } ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?= $form->field($model, 'deals_content')->textarea(['rows' => 4]) ?>

    <?php
        $imagesFullPath = [];
        $initialPreviewConfig = [];
        $smallImagesFullPath = [];
        $smallInitialPreviewConfig = [];
        $path = 'images/uploaded/deals/'. $model->deals_id . '/';
        if (is_dir($path)) {
            $images =  FileHelper::findFiles($path);

            if (!empty($model->deals_image_front)) {
                $smallImagesFullPath[] = Html::img(Url::to('@web/' . $path .  $model->deals_image_front), ['class'=>'file-preview-image']);
            }
            if (!empty($model->deals_image_back)) {
                $imagesFullPath[] = Html::img(Url::to('@web/' . $path .  $model->deals_image_back), ['class'=>'file-preview-image']);
            }

            $smallInitialPreviewConfig[] = ['caption' => '', 'width' => "120px", 'url' => "/deals/" . $model->deals_id . "/delete-front-image/", 'key' => ''];
            $initialPreviewConfig[] = ['caption' => '', 'width' => "120px", 'url' => "/deals/" . $model->deals_id . "/delete-back-image/", 'key' => ''];
        }
    ?>

    <?php if (empty($isCreate)) { ?>

        <?=  $form->field($model, 'small_image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>$smallImagesFullPath,
                'initialPreviewConfig' => $smallInitialPreviewConfig,
                'overwriteInitial'=>false,
                'maxFileCount' => 1,
            ]
        ])?>

        <?=  $form->field($model, 'full_image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>$imagesFullPath,
                'initialPreviewConfig' => $initialPreviewConfig,
                'overwriteInitial'=>false,
                'maxFileCount' => 1,
            ]
        ])?>

    <?php } ?>

    <?= $form->field($model, 'deals_sort')->textInput() ?>

    <!-- <?= $form->field($model, 'old_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
