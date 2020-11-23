<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Servises */

$this->title = 'Создать услугу';
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servises-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'isCreate' => true,
    ]) ?>

</div>
