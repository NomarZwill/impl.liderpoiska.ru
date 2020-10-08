<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Servises */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servises-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'servise_title')->textInput() ?>

    <?= $form->field($model, 'servise_long_title')->textInput() ?>

    <?= $form->field($model, 'servise_description')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'introtext')->textInput() ?>

    <?= $form->field($model, 'alias')->textInput() ?>

    <?= $form->field($model, 'menu_title')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'head_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'service_to_price_list')->textInput() ?>

    <?= $form->field($model, 'price_to_service')->textInput() ?>

    <?= $form->field($model, 'medic_to_service')->textInput() ?>

    <?= $form->field($model, 'review_to_service')->textInput() ?>

    <?= $form->field($model, 'query_to_service')->textInput() ?>

    <?= $form->field($model, 'padej_predl')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'price_title')->textInput() ?>

    <?= $form->field($model, 'review_title')->textInput() ?>

    <?= $form->field($model, 'faq_title')->textInput() ?>

    <?= $form->field($model, 'medic_title')->textInput() ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'old_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
