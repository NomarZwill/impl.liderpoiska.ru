<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/**
 *
 * @var yii\web\View $this
 * @var common\html_constructor\models\HcDraft $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Hc Draft');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Hc Drafts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="giiant-crud hc-draft-view">

	<!-- flash message -->
	<?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
		<span class="alert alert-info alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			<?php echo \Yii::$app->session->getFlash('deleteError') ?>
		</span>
	<?php endif; ?>

	<h1>
		<?php echo Yii::t('models', 'Hc Draft') ?>
		<small>
			<?php echo Html::encode($model->name) ?>
		</small>
	</h1>


	<div class="clearfix crud-navigation">

		<!-- menu buttons -->
		<div class='pull-left'>
			<?php echo Html::a(
				'<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('cruds', 'Edit'),
				['update', 'id' => $model->id],
				['class' => 'btn btn-info']
			) ?>

			<?php echo Html::a(
				'<span class="glyphicon glyphicon-copy"></span> ' . Yii::t('cruds', 'Copy'),
				['create', 'id' => $model->id, 'HcDraft' => $copyParams],
				['class' => 'btn btn-success']
			) ?>

			<?php echo Html::a(
				'<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New'),
				['create'],
				['class' => 'btn btn-success']
			) ?>
		</div>

		<div class="pull-right">
			<?php echo Html::a('<span class="glyphicon glyphicon-list"></span> '
				. Yii::t('cruds', 'Full list'), ['index'], ['class' => 'btn btn-default']) ?>
		</div>

	</div>

	<hr />

	<?php $this->beginBlock('common\html_constructor\models\HcDraft'); ?>


	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'name',
			'alias',
			'intro:ntext',
			'short_intro:ntext',
			[
				'attribute' => 'published',
				'value' => ($model->published
					? '<i class="fa fa-check fa-green fa-large"></i>'
					: '<i class="fa fa-close fa-red fa-large"></i>'),
				'format' => 'html',
			],
			[
				'attribute' => 'featured',
				'value' => ($model->featured
					? '<i class="fa fa-check fa-green fa-large"></i>'
					: '<i class="fa fa-close fa-red fa-large"></i>'),
				'format' => 'html',
			],
			'created_at',
			'published_at',
			// 'sort',
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
			[
				'format' => 'html',
				'attribute' => 'created_by',
				'value' => ($model->createdBy ?
					Html::a('<i class="glyphicon glyphicon-list"></i>', ['/user/index']) . ' ' .
					Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> ' . $model->createdBy->email, ['/user/view', 'id' => $model->createdBy->id,])
					:
					'<span class="label label-warning">?</span>'),
			],
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
			[
				'format' => 'html',
				'attribute' => 'updated_by',
				'value' => ($model->updatedBy ?
					Html::a('<i class="glyphicon glyphicon-list"></i>', ['/user/index']) . ' ' .
					Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> ' . $model->updatedBy->email, ['/user/view', 'id' => $model->updatedBy->id,])
					:
					'<span class="label label-warning">?</span>'),
			],

		],
	]); ?>


	<hr />

	<?php echo Html::a(
		'<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('cruds', 'Delete'),
		['delete', 'id' => $model->id],
		[
			'class' => 'btn btn-danger',
			'data-confirm' => '' . Yii::t('cruds', 'Are you sure to delete this item?') . '',
			'data-method' => 'post',
		]
	); ?>

	<?php $this->endBlock(); ?>

	<?php $this->beginBlock('Media');

	echo $this->render('@common/html_constructor/views/media_tab.php', ['model' => $model]);

	$this->endBlock() ?>

	<?php $this->beginBlock('Seo');

	echo $this->render('@common/html_constructor/views/seo_tab.php', ['model' => $model]);

	$this->endBlock() ?>

	<?php echo Tabs::widget(
		[
			'id' => 'relation-tabs',
			'encodeLabels' => false,
			'items' => [
				[
					'label'   => '<b class=""># ' . Html::encode($model->id) . '</b>',
					'content' => $this->blocks['common\html_constructor\models\HcDraft'],
					'active'  => true,
				],
				[
					'content' => $this->blocks['Media'],
					'label'   => '<small>Файлы <span class="badge badge-default">' . $model->getFileTargets()->count() . '</span></small>',
					'active'  => false,
				],
				[
					'content' => $this->blocks['Seo'],
					'label'   => '<small>SEO<span class="badge badge-default"></span></small>',
					'active'  => false,
				],
			]
		]
	);
	?>
</div>