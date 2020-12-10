<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Banners */

$this->title = 'Обновить баннер: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Баннеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="banners-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
