<?php

use yii\helpers\Html;

/**
 *
 * @var yii\web\View $this
 * @var common\html_constructor\models\HcDraft $model
 */
$this->title = Yii::t('models', 'Hc Draft');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Hc Drafts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud hc-draft-create">

    <h1>
        <?php echo Yii::t('models', 'Hc Draft') ?>
        <small>
            <?php echo Html::encode($model->name) ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?php echo             Html::a(
                Yii::t('cruds', 'Cancel'),
                \yii\helpers\Url::previous(),
                ['class' => 'btn btn-default']
            ) ?>
        </div>
    </div>

    <hr />

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>