<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OurWorks */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Наши работы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="our-works-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'isCreate' => true,
    ]) ?>

</div>
