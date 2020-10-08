<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать отзыв', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'review_id',
                'contentOptions' => [
                    'style' => [
                        'width' => '50px',
                        'white-space' => 'normal',
                    ],
                ],
            ],

            [
                'attribute' => 'author',
                'contentOptions' => [
                    'style' => [
                        'width' => '200px',
                        'white-space' => 'normal',
                    ],
                ],
            ],

            [
                'attribute' => 'date',
                'contentOptions' => [
                    'style' => [
                        'width' => '100px',
                        'white-space' => 'normal',
                    ],
                ],
            ],
            // 'published',
            // 'review_text:ntext',
            [
                'attribute' => 'review_text',
                'contentOptions' => [
                    'style' => [
                        'max-width' => '400px',
                        'white-space' => 'normal',
                    ],
                ],
            ],
            //'review_title:ntext',
            //'old_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
