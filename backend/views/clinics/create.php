<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Clinics */

$this->title = 'Добавить клинику';
$this->params['breadcrumbs'][] = ['label' => 'Клиники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clinics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'isCreate' => true,
    ]) ?>

</div>
