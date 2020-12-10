<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SeoSinglePagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SEO для общих страниц';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-single-pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'contentOptions' => [
                    'style' => [
                        'width' => '50px',
                        'white-space' => 'normal',
                    ],
                ],
            ],
            'name:ntext',
            'title:ntext',
            // 'description:ntext',
            // 'keywords:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
