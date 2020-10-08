<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Clinics */

$this->title = $model->clinic_id;
$this->params['breadcrumbs'][] = ['label' => 'Клиники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clinics-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->clinic_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->clinic_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту клинику?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'clinic_id',
            'clinic_title:ntext',
            'clinic_long_title:ntext',
            'clinic_description:ntext',
            'alias:ntext',
            'menu_title:ntext',
            'card_title:ntext',
            'content:ntext',
            'clinic_address:ntext',
            'clinic_address_short:ntext',
            'clinic_phone:ntext',
            'clinic_whatsapp:ntext',
            'clinic_mail:ntext',
            'clinic_site:ntext',
            'clinic_coords:ntext',
            'clinic_latitude',
            'clinic_longitude',
            'clinic_opening_hours:ntext',
            'clinic_map:ntext',
            'main_phone:ntext',
            'keywords:ntext',
            'review_to_filial:ntext',
            'review_title:ntext',
            'bottom_text:ntext',
            'old_id',
        ],
    ]) ?>

</div>
