<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use backend\models\LicensePageGalleries;

/* @var $this yii\web\View */
/* @var $model backend\models\LicensesDocumentsPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="licenses-documents-page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $licensesInitialPreview = [];
        $licensesInitialPreviewConfig = [];
        $path = 'images/uploaded/licensesDocumentsPage/licenses/';
        if (is_dir($path)) {
            $images = LicensePageGalleries::find()->where(['gallery_type' => 'licenses', 'parent_id' => $model->id])->all();
            foreach ($images as $image) {
                $licensesInitialPreview[] = Html::img(Url::to("@web/$image->filepath"), ['class'=>'file-preview-image']);
                $licensesInitialPreviewConfig[] = ['caption' => '', 'width' => "120px", 'url' => "/licenses-documents-page/" . $model->id . "/delete-gallery-image/" . $image->id . '/', 'key' => ''];
            }
        }

        $documentsInitialPreview = [];
        $documentsInitialPreviewConfig = [];
        $path = 'images/uploaded/licensesDocumentsPage/documents/';
        if (is_dir($path)) {
            $docs = LicensePageGalleries::find()->where(['gallery_type' => 'documents', 'parent_id' => $model->id])->all();
            foreach ($docs as $doc) {
                $documentsInitialPreview[] = Html::img(Url::to("@web/images/uploaded/licensesDocumentsPage/file.png"), ['class'=>'file-preview-image']);
                $documentsInitialPreviewConfig[] = ['caption' => $doc->filepath, 'width' => "120px", 'url' => "/licenses-documents-page/" . $model->id . "/delete-document/" . $doc->id . '/', 'key' => ''];
            }
        }
    ?>

    <?php if (empty($isCreate)){ ?>

        <?=  $form->field($model, 'licenses_gallery_images[]')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
                'multiple' => true,
            ],
            'pluginOptions' => [
                'initialPreview'=>$licensesInitialPreview,
                'initialPreviewConfig' => $licensesInitialPreviewConfig,
                'overwriteInitial'=>false,
            ]
        ])?>

    <?php } ?>

    <?php if (empty($isCreate)){ ?>

<?=  $form->field($model, 'documents_list[]')->widget(FileInput::classname(), [
    'options' => [
        // 'accept' => 'image/*',
        'multiple' => true,
    ],
    'pluginOptions' => [
        'initialPreview'=>$documentsInitialPreview,
        'initialPreviewConfig' => $documentsInitialPreviewConfig,
        'overwriteInitial'=>false,
    ]
])?>

<?php } ?>

    <!-- <?= $form->field($model, 'licenses')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'documents')->textarea(['rows' => 6]) ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
