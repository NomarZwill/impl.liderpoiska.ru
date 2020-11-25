<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Servises;

/* @var $this yii\web\View */
/* @var $model backend\models\Servises */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servises-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'servise_title')->textInput() ?>

    <?= $form->field($model, 'servise_long_title')->textInput() ?>

    <?= $form->field($model, 'servise_description')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'h1_title')->textInput() ?>

    <?= $form->field($model, 'header_menu_title')->textInput() ?>

    <?php
        $allServisesData = Servises::getArrayToSelect2();
        $allServisesData[0] = 'Основной раздел, родительская услуга отсутствует';
        $activeParentServises = Servises::getServiceParentIDs($model->servise_id);
        // print_r($allServisesData);
        // exit;
    ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::classname(), [
        'data' => $allServisesData,
        //'maintainOrder' => true,
        'options' => ['value' => $activeParentServises, 'placeholder' => 'Выберите родительскую услугу', 'multiple' => false],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);?>

    <?php if ($model->parent_id === 0){ ?>

        <?= $form->field($model, 'servise_listing_sort')->textInput() ?>

    <?php } else { ?>

        <?= $form->field($model, 'servise_parent_block_sort')->textInput() ?>

    <?php } ?>

    <?php if (empty($isCreate)){ ?>

        <?= $form->field($model, 'alias')->textInput() ?>

    <?php } ?>

    <?= $form->field($model, 'head_text')->textarea(['rows' => 4]) ?>

    <?php if (empty($isCreate)){ ?>

        <div class="form_draft_link_wrapper">
            <a class="form_draft_link" href="/hc-draft/<?= $model->servise_hc_draft_id ?>/update/">Перейти к конструктору блоков</a>
        </div>

    <?php } ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?= $form->field($model, 'is_visible_in_menu')->checkbox() ?>

    <!-- <?= $form->field($model, 'introtext')->textInput() ?> -->

    <!-- <?= $form->field($model, 'menu_title')->textInput() ?> -->

    <!-- <?= $form->field($model, 'content')->textarea(['rows' => 1]) ?> -->

    <!-- <?= $form->field($model, 'service_to_price_list')->textInput() ?> -->

    <!-- <?= $form->field($model, 'price_to_service')->textInput() ?> -->

    <!-- <?= $form->field($model, 'medic_to_service')->textInput() ?> -->

    <!-- <?= $form->field($model, 'review_to_service')->textInput() ?> -->

    <!-- <?= $form->field($model, 'query_to_service')->textInput() ?> -->

    <!-- <?= $form->field($model, 'padej_predl')->textInput() ?> -->

    <!-- <?= $form->field($model, 'price_title')->textInput() ?> -->

    <!-- <?= $form->field($model, 'review_title')->textInput() ?> -->

    <!-- <?= $form->field($model, 'faq_title')->textInput() ?> -->

    <!-- <?= $form->field($model, 'medic_title')->textInput() ?> -->

    <!-- <?= $form->field($model, 'parent_id')->textInput() ?> -->

    <!-- <?= $form->field($model, 'old_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
