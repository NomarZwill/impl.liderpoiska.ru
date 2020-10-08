<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Servises */

$this->title = $model->servise_id;
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="servises-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->servise_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->servise_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту услугу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'servise_id',
            'servise_title:ntext',
            'servise_long_title:ntext',
            'servise_description:ntext',
            'introtext:ntext',
            'alias:ntext',
            'menu_title:ntext',
            'content:ntext',
            'image:ntext',
            'head_text:ntext',
            'service_to_price_list:ntext',
            'price_to_service:ntext',
            'medic_to_service:ntext',
            'review_to_service:ntext',
            'query_to_service:ntext',
            'padej_predl:ntext',
            'keywords:ntext',
            'price_title:ntext',
            'review_title:ntext',
            'faq_title:ntext',
            'medic_title:ntext',
            'index_id',
            'servise_listing_id',
            'parent_id',
            'old_id',
        ],
    ]) ?>

</div>
