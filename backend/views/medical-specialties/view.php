<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalSpecialties */

$this->title = $model->specialty_id;
$this->params['breadcrumbs'][] = ['label' => 'Medical Specialties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="medical-specialties-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->specialty_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->specialty_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'specialty_id',
            'specialty_title:ntext',
            'specialty_long_title:ntext',
            'specialty_description:ntext',
            'introtext:ntext',
            'alias:ntext',
            'menu_title:ntext',
            'content:ntext',
            'speciality_review:ntext',
            'head_text:ntext',
            'price_title:ntext',
            'review_title:ntext',
            'faq_title:ntext',
            'medic_to_special:ntext',
            'query_to_service:ntext',
            'price_to_service:ntext',
            'keywords:ntext',
            'old_id',
        ],
    ]) ?>

</div>
