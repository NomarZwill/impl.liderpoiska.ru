<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RatingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рейтинги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ratings-index">

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

            // 'id',
            'rating_name:ntext',
            'name:ntext',
            'icon:ntext',
            // 'link_to_agregator:ntext',
            'average_rating',
            // 'clinic_id:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
