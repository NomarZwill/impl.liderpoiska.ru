<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Врачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить врача', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'doctor_id',
                'contentOptions' => [
                    'style' => [
                        'width' => '50px',
                        'white-space' => 'normal',
                    ],
                ],
            ],

            [
                'attribute' => 'doctor_title',
                'contentOptions' => [
                    'style' => [
                        'max-width' => '1200px',
                        'white-space' => 'normal',
                    ],
                ],
            ],

            // 'doctor_long_title:ntext',
            // 'doctor_description:ntext',
            // 'introtext:ntext',
            //'alias:ntext',
            //'content:ntext',
            //'doctor_education:ntext',
            //'doctor_image:ntext',
            //'medic_to_filial:ntext',
            //'sort_lab_smail:ntext',
            //'sort_doyche_velle:ntext',
            //'sort_esteticheskaya_stomatologiya_chistie_prudi:ntext',
            //'sort_esteticheskaya_stomatologiya:ntext',
            //'sort_impl:ntext',
            //'sort_centr_implantologii:ntext',
            //'review_to_specials:ntext',
            //'specials_to_medic:ntext',
            //'review_title:ntext',
            //'query_to_service:ntext',
            //'faq_title:ntext',
            //'sort_klinika_dentalgeneva:ntext',
            //'sort_prec_1005:ntext',
            //'sort_prec_1154:ntext',
            //'sort_prec_1459:ntext',
            //'sort_prec_988:ntext',
            //'sort_prec_989:ntext',
            //'sort_prec_990:ntext',
            //'sort_prec_991:ntext',
            //'sort_prec_992:ntext',
            //'sort_prec_994:ntext',
            //'old_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
