<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DealsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Спецпредложения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить спецпредложение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'deals_id',
                'contentOptions' => [
                    'style' => [
                        'width' => '50px',
                        'white-space' => 'normal',
                    ],
                ],
            ],
            
            'deals_title:ntext',
            // 'deals_long_title:ntext',
            // 'deals_description:ntext',

            [
                'attribute' => 'deals_index_description',
                'contentOptions' => [
                    'style' => [
                        'max-width' => '1000px',
                        'white-space' => 'normal',
                    ],
                ],
            ],

            //'deals_index_image:ntext',
            //'alias:ntext',
            //'deals_image_front:ntext',
            //'deals_image_back:ntext',
            //'deals_content:ntext',
            //'old_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
