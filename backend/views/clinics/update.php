<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Clinics */

$this->title = 'Обновить клинику: ' . $model->clinic_id;
$this->params['breadcrumbs'][] = ['label' => 'Клиники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->clinic_id, 'url' => ['view', 'id' => $model->clinic_id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="clinics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
