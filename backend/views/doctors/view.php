<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Doctors */

$this->title = $model->doctor_id;
$this->params['breadcrumbs'][] = ['label' => 'Врачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="doctors-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->doctor_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->doctor_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этого врача?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'doctor_id',
            'doctor_title:ntext',
            'doctor_long_title:ntext',
            'doctor_description:ntext',
            'introtext:ntext',
            'alias:ntext',
            'content:ntext',
            'doctor_education:ntext',
            'doctor_image:ntext',
            'medic_to_filial:ntext',
            'sort_lab_smail:ntext',
            'sort_doyche_velle:ntext',
            'sort_esteticheskaya_stomatologiya_chistie_prudi:ntext',
            'sort_esteticheskaya_stomatologiya:ntext',
            'sort_impl:ntext',
            'sort_centr_implantologii:ntext',
            'review_to_specials:ntext',
            'specials_to_medic:ntext',
            'review_title:ntext',
            'query_to_service:ntext',
            'faq_title:ntext',
            'sort_klinika_dentalgeneva:ntext',
            'sort_prec_1005:ntext',
            'sort_prec_1154:ntext',
            'sort_prec_1459:ntext',
            'sort_prec_988:ntext',
            'sort_prec_989:ntext',
            'sort_prec_990:ntext',
            'sort_prec_991:ntext',
            'sort_prec_992:ntext',
            'sort_prec_994:ntext',
            'old_id',
        ],
    ]) ?>

</div>
