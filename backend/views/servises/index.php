<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ServisesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Услуги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servises-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать услугу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'servise_id',
                'contentOptions' => [
                    'style' => [
                        'width' => '50px',
                        'white-space' => 'normal',
                    ],
                ],
            ],

            'servise_title:ntext',
            // 'servise_long_title:ntext',
            // 'servise_description:ntext',
            // 'introtext:ntext',
            //'alias:ntext',
            //'menu_title:ntext',
            //'content:ntext',
            //'image:ntext',
            //'head_text:ntext',
            //'service_to_price_list:ntext',
            //'price_to_service:ntext',
            //'medic_to_service:ntext',
            //'review_to_service:ntext',
            //'query_to_service:ntext',
            //'padej_predl:ntext',
            //'keywords:ntext',
            //'price_title:ntext',
            //'review_title:ntext',
            //'faq_title:ntext',
            //'medic_title:ntext',
            //'index_id',
            //'servise_listing_id',
            //'parent_id',
            //'old_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
