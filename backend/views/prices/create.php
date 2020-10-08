<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Prices */

$this->title = 'Добавить цену';
$this->params['breadcrumbs'][] = ['label' => 'Цены', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
