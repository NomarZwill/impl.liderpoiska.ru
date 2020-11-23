<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Doctors;
use backend\models\Servises;

/**
 *
 * @var yii\web\View $this
 * @var common\html_constructor\models\HcDraft $model
 */
$this->title = Yii::t('models', 'Hc Draft');

if (Doctors::find()->where(['doctor_hc_draft_id' => $model->id])->exists()) {
    $isBackLink = true;
    $itemRel = Doctors::find()->where(['doctor_hc_draft_id' => $model->id])->one();
    $itemTitle = $itemRel->doctor_title;
    $itemLink = Url::toRoute('/doctors/' . $itemRel->doctor_id . '/update\/');
} else if (Servises::find()->where(['servise_hc_draft_id' => $model->id])->exists()) {
    $isBackLink = true;
    $itemRel = Servises::find()->where(['servise_hc_draft_id' => $model->id])->one();
    $itemTitle = $itemRel->menu_title;
    $itemLink = Url::toRoute('/servises/' . $itemRel->servise_id . '/update\/');
} else {
    $isBackLink = false;
}

$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Hc Draft'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => (string)$doctorRel->doctor_title, 'url' => Url::toRoute('/doctors/' . $itemRel->doctor_id . '/update\/')];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Edit');
?>
<div class="giiant-crud hc-draft-update">

    <h1>
        <?php echo Yii::t('models', 'Hc Draft') ?>
        <small>
            <?php echo Html::encode($model->name) ?>
        </small>
    </h1>

    <div class="crud-navigation">
        <?php echo Html::a('<span class="glyphicon glyphicon-file"></span> ' . Yii::t('cruds', 'View'), ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php 
        if ($isBackLink) {
    ?>

        <div class="form_draft_link_wrapper">
            <a class="form_draft_link" href="<?= $itemLink ?>">Вернуться к редактированию: <?= $itemTitle ?></a>
        </div>

    <?php 
        }
    ?>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>