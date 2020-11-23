<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MedicalSpecialtiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Специальности';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-specialties-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить специальность', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'specialty_id',
                'contentOptions' => [
                    'style' => [
                        'width' => '50px',
                        'white-space' => 'normal',
                    ],
                ],
            ],
            'specialty_title:ntext',
            // 'specialty_long_title:ntext',
            // 'specialty_description:ntext',
            // 'introtext:ntext',
            //'alias:ntext',
            //'menu_title:ntext',
            //'content:ntext',
            //'speciality_review:ntext',
            //'head_text:ntext',
            //'price_title:ntext',
            //'review_title:ntext',
            //'faq_title:ntext',
            //'medic_to_special:ntext',
            //'query_to_service:ntext',
            //'price_to_service:ntext',
            //'keywords:ntext',
            //'old_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
