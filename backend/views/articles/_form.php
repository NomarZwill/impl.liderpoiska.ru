<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'h1_title')->textInput() ?>

    <?php if (empty($isCreate)){ ?>

        <?= $form->field($model, 'alias')->textInput() ?>

        <?= $form->field($model, 'is_active')->checkbox() ?>

        <?php
            $initialPreview = [];
            $initialPreviewConfig = [];
            $path = 'images/uploaded/articles/'. $model->id . '/';
            if (is_dir($path)) {
                $images =  FileHelper::findFiles($path);

                if (!empty($model->preview_image)) {
                    $initialPreview[] = Html::img(Url::to('@web/' . $path .  $model->preview_image), ['class'=>'file-preview-image']);
                }

                $initialPreviewConfig[] = ['caption' => '', 'width' => "120px", 'url' => "/articles/" . $model->id . "/delete-image/", 'key' => ''];
            }
        ?>

        <?=  $form->field($model, 'preview_image_load')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>$initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig,
                'overwriteInitial'=>false,
                'maxFileCount' => 1,
            ]
        ])?>

    <?php } ?>

    <?= $form->field($model, 'publishing_date')->textInput() ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'head_text')->textarea(['rows' => 4]) ?>

    <?php if (empty($isCreate)){ ?>

        <div class="form_draft_link_wrapper">
            <a class="form_draft_link" href="/hc-draft/<?= $model->article_hc_draft_id ?>/update/">Перейти к конструктору блоков</a>
        </div>

    <?php } ?>

    <!-- <?= $form->field($model, 'page_rating')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'page_votes')->textInput() ?> -->

    <!-- <?= $form->field($model, 'article_hc_draft_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
