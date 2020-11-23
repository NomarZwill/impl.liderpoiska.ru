<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalSpecialties */

$this->title = 'Редактировать специальности: ' . $model->specialty_title;
$this->params['breadcrumbs'][] = ['label' => 'Специальность', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->specialty_title, 'url' => ['view', 'id' => $model->specialty_id]];
$this->params['breadcrumbs'][] = $model->specialty_title;
?>
<div class="medical-specialties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
