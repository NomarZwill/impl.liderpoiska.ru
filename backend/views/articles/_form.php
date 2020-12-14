<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

        <?= $form->field($model, 'is_active')->textInput() ?>

    <?php } ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'head_text')->textarea(['rows' => 4]) ?>

    <?php if (empty($isCreate)){ ?>

        <div class="form_draft_link_wrapper">
            <a class="form_draft_link" href="/hc-draft/<?= $model->article_hc_draft_id ?>/update/">Перейти к конструктору блоков</a>
        </div>

    <?php } ?>

    <!-- <?= $form->field($model, 'article_rating')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'article_votes')->textInput() ?> -->

    <!-- <?= $form->field($model, 'article_hc_draft_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
