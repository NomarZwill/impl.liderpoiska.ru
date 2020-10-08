<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClinicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clinics-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить клинику', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'clinic_id',
                'contentOptions' => [
                    'style' => [
                        'width' => '50px',
                        'white-space' => 'normal',
                    ],
                ],
            ],

            'clinic_title:ntext',

            [
                'attribute' => 'clinic_address',
                'contentOptions' => [
                    'style' => [
                        'max-width' => '400px',
                        'white-space' => 'normal',
                    ],
                ],
            ],
            
            // 'clinic_long_title:ntext',
            // 'clinic_description:ntext',
            // 'alias:ntext',
            //'menu_title:ntext',
            //'card_title:ntext',
            //'content:ntext',
            //'clinic_address_short:ntext',
            //'clinic_phone:ntext',
            //'clinic_whatsapp:ntext',
            //'clinic_mail:ntext',
            //'clinic_site:ntext',
            //'clinic_coords:ntext',
            //'clinic_latitude',
            //'clinic_longitude',
            //'clinic_opening_hours:ntext',
            //'clinic_map:ntext',
            //'main_phone:ntext',
            //'keywords:ntext',
            //'review_to_filial:ntext',
            //'review_title:ntext',
            //'bottom_text:ntext',
            //'old_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
