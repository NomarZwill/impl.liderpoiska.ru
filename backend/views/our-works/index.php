<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OurWorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Наши работы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="our-works-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'alias:ntext',
            'title:ntext',
            // 'description:ntext',
            // 'keywords:ntext',
            //'h1:ntext',
            //'service_id',
            //'draft_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
