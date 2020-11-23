<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LicensesDocumentsPage */

$this->title = 'Обновить лицензии и документы';
$this->params['breadcrumbs'][] = ['label' => 'Лицензии и документы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="licenses-documents-page-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
