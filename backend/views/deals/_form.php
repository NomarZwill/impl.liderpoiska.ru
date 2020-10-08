<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Deals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deals-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'deals_title')->textInput() ?>

    <?= $form->field($model, 'deals_long_title')->textInput() ?>

    <?= $form->field($model, 'deals_description')->textInput() ?>

    <?= $form->field($model, 'deals_image_front')->textInput() ?>

    <?= $form->field($model, 'deals_image_back')->textInput() ?>

    <?= $form->field($model, 'deals_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'old_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
