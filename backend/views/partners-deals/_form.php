<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\PartnersDeals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partners-deals-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'partner_name')->textInput() ?>    

    <?php
        $initialPreview = [];
        $initialPreviewConfig = [];
        $path = 'images/uploaded/partnersDeals/'. $model->id . '/';
        if (is_dir($path)) {
            $images =  FileHelper::findFiles($path);

            if (!empty($model->partner_image)) {
                $initialPreview[] = Html::img(Url::to('@web/' . $path .  $model->partner_image), ['class'=>'file-preview-image']);
            }

            $initialPreviewConfig[] = ['caption' => '', 'width' => "120px", 'url' => "/partners-deals/" . $model->id . "/delete-image/", 'key' => ''];
        }
    ?>

    <?php if (empty($isCreate)){ ?>

        <?=  $form->field($model, 'full_image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>$initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig,
                'overwriteInitial'=>false,
                'maxFileCount' => 1,
            ]
        ])?>

    <?php } ?>

    <!-- <?= $form->field($model, 'partner_image')->textarea(['rows' => 6]) ?> -->

    <?= $form->field($model, 'deal_text')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
