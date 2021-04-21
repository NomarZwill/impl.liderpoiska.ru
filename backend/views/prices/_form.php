<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Servises;
use backend\models\ServiceAndPrices;
use backend\models\Articles;
use backend\models\ArticlesPricesRel;

/* @var $this yii\web\View */
/* @var $model backend\models\Prices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prices_name')->textInput() ?>

    <?= $form->field($model, 'prices_description')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?php if (empty($isCreate)){ ?>

        <?php
            $allServicesData = Servises::getArrayToSelect2();
            $activePriceServices = ServiceAndPrices::getPriceServiceIDs($model->prices_id);
        ?>

        <?= $form->field($model, 'price_services_rel')->widget(Select2::classname(), [
            'data' => $allServicesData,
            //'maintainOrder' => true,
            'options' => ['value' => $activePriceServices, 'placeholder' => 'Выберите услуги', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);?>

        <?php
            $allArticlesData = Articles::getArrayToSelect2();
            $activePriceArticles = ArticlesPricesRel::getPriceArticleIDs($model->prices_id);
        ?>

        <?= $form->field($model, 'price_articles_rel')->widget(Select2::classname(), [
            'data' => $allArticlesData,
            'options' => ['value' => $activePriceArticles, 'placeholder' => 'Выберите статьи', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);?>

    <?php } ?>


    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'price_hide')->textInput() ?>
    
    <?= $form->field($model, 'link')->textInput() ?>
    
    <?= $form->field($model, 'text_1')->textInput() ?>

    <!-- <?= $form->field($model, 'alias')->textInput() ?> -->


    <!-- <?= $form->field($model, 'old_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
