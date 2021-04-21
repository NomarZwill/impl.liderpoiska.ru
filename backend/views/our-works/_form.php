<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Servises;

/* @var $this yii\web\View */
/* @var $model backend\models\OurWorks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="our-works-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (empty($isCreate)){ ?>
        
        <?= $form->field($model, 'alias')->textInput() ?>
        
    <?php } ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'h1')->textInput() ?>

    <?php
        $allOurWorksData = Servises::getArrayToSelect2();
        $activeWork = isset($model->service_id) ? $model->service_id : '';
    ?>

    <?= $form->field($model, 'service_id')->widget(Select2::classname(), [
        'data' => $allOurWorksData,
        'options' => ['value' => $activeWork, 'placeholder' => 'Выберите услугу', 'multiple' => false],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);?>


    <?php if (empty($isCreate)){ ?>
        
        <div class="form_draft_link_wrapper">
            <a class="form_draft_link" href="/hc-draft/<?= $model->draft_id ?>/update/">Перейти к конструктору блоков</a>
        </div>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
