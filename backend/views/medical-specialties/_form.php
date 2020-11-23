<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalSpecialties */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medical-specialties-form">
    
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'specialty_title')->textInput() ?>

    <?= $form->field($model, 'specialty_long_title')->textInput() ?>
    
    <?= $form->field($model, 'introtext')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'h1_title')->textInput() ?>

    <?= $form->field($model, 'menu_title')->textInput() ?>

    <?= $form->field($model, 'breadcrumbs_title')->textInput() ?>

    <?php if (empty($isCreate)){ ?>
    
        <?= $form->field($model, 'alias')->textInput() ?>

    <?php } ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?= $form->field($model, 'specialty_sort')->textInput() ?>

    <?= $form->field($model, 'head_text')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'spec_title_second')->textInput() ?>

    <?= $form->field($model, 'review_title')->textInput() ?>
    
    <?= $form->field($model, 'first_content_block')->textarea(['rows' => 4]) ?>
    
    <?= $form->field($model, 'second_content_block')->textarea(['rows' => 4]) ?>
    
    <?= $form->field($model, 'third_content_block')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'last_content_block')->textarea(['rows' => 4]) ?>

    <!-- <?= $form->field($model, 'specialty_title')->textarea(['rows' => 6]) ?> -->
    
    <!-- <?= $form->field($model, 'specialty_description')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'speciality_review')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'head_text')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'price_title')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'review_title')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'faq_title')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'medic_to_special')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'query_to_service')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'price_to_service')->textarea(['rows' => 6]) ?> -->


    <!-- <?= $form->field($model, 'old_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
