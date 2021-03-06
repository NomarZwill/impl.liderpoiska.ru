<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\bootstrap\Tabs;

/**
 *
 * @var yii\web\View $this
 * @var common\html_constructor\models\HcTag $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('models', 'Hc Tag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Hc Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'View');
?>
<div class="giiant-crud hc-tag-view">

	<!-- flash message -->
	<?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
		<span class="alert alert-info alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			<?php echo \Yii::$app->session->getFlash('deleteError') ?>
		</span>
	<?php endif; ?>

	<h1>
		<?php echo Yii::t('models', 'Hc Tag') ?>
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
				['create', 'id' => $model->id, 'HcTag' => $copyParams],
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

	<?php $this->beginBlock('common\html_constructor\models\HcTag'); ?>


	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'name',
			'alias',
			//'parent_id',
			//'sort',
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
			[
				'format' => 'html',
				'attribute' => 'created_by',
				'value' => ($model->createdBy ?
					Html::a('<i class="glyphicon glyphicon-list"></i>', ['/user/index']) . ' ' .
					Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> ' . $model->createdBy->id, ['/user/view', 'id' => $model->createdBy->id,]) . ' ' .
					Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'HcTag' => ['created_by' => $model->created_by]])
					:
					'<span class="label label-warning">?</span>'),
			],
			// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
			[
				'format' => 'html',
				'attribute' => 'updated_by',
				'value' => ($model->updatedBy ?
					Html::a('<i class="glyphicon glyphicon-list"></i>', ['/user/index']) . ' ' .
					Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> ' . $model->updatedBy->id, ['/user/view', 'id' => $model->updatedBy->id,]) . ' ' .
					Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'HcTag' => ['updated_by' => $model->updated_by]])
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



	<?php $this->beginBlock('HcDraftTags'); ?>
	<div style='position: relative'>
		<div style='position:absolute; right: 0px; top: 0px;'>
			<?php echo Html::a(
				'<span class="glyphicon glyphicon-list"></span> ' . Yii::t('cruds', 'List All') . ' Hc Draft Tags',
				['/hc-draft-tag/index'],
				['class' => 'btn text-muted btn-xs']
			) ?>
			<?php echo Html::a(
				'<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New') . ' Hc Draft Tag',
				['/hc-draft-tag/create', 'HcDraftTag' => ['hc_tag_id' => $model->id]],
				['class' => 'btn btn-success btn-xs']
			); ?>
		</div>
	</div>
	<?php Pjax::begin(['id' => 'pjax-HcDraftTags', 'enableReplaceState' => false, 'linkSelector' => '#pjax-HcDraftTags ul.pagination a, th a']) ?>
	<?php echo
		'<div class="table-responsive">'
			. \yii\grid\GridView::widget([
				'layout' => '{summary}<div class="text-center">{pager}</div>{items}<div class="text-center">{pager}</div>',
				'dataProvider' => new \yii\data\ActiveDataProvider([
					'query' => $model->getHcDraftTags(),
					'pagination' => [
						'pageSize' => 20,
						'pageParam' => 'page-blogposttags',
					]
				]),
				'pager'        => [
					'class'          => yii\widgets\LinkPager::className(),
					'firstPageLabel' => Yii::t('cruds', 'First'),
					'lastPageLabel'  => Yii::t('cruds', 'Last')
				],
				'columns' => [
					// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
					[
						'class' => yii\grid\DataColumn::className(),
						'attribute' => 'hc_draft_id',
						'value' => function ($model) {
							if ($rel = $model->hcDraft) {
								return Html::a($rel->name, ['/hc-draft/view', 'id' => $rel->id,], ['data-pjax' => 0]);
							} else {
								return '';
							}
						},
						'format' => 'raw',
					],
					'sort',
					[
						'class'      => 'yii\grid\ActionColumn',
						'template'   => '{view} {update}',
						'contentOptions' => ['nowrap' => 'nowrap'],
						'urlCreator' => function ($action, $model, $key, $index) {
							// using the column name as key, not mapping to 'id' like the standard generator
							$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
							$params[0] = '/hc-draft-tag' . '/' . $action;
							$params['HcDraftTag'] = ['hc_tag_id' => $model->primaryKey()[0]];
							return $params;
						},
						'buttons'    => [],
						'controller' => '/hc-draft-tag'
					],
				]
			])
			. '</div>'
	?>
	<?php Pjax::end() ?>
	<?php $this->endBlock() ?>


	<?php $this->beginBlock('HcDrafts'); ?>
	<div style='position: relative'>
		<div style='position:absolute; right: 0px; top: 0px;'>
			<?php echo Html::a(
				'<span class="glyphicon glyphicon-list"></span> ' . Yii::t('cruds', 'List All') . ' Hc Drafts',
				['/hc-draft/index'],
				['class' => 'btn text-muted btn-xs']
			) ?>
			<?php echo Html::a(
				'<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New') . ' Hc Draft',
				['/hc-draft/create', 'HcDraft' => ['id' => $model->id]],
				['class' => 'btn btn-success btn-xs']
			); ?>
			<?php echo Html::a(
				'<span class="glyphicon glyphicon-link"></span> ' . Yii::t('cruds', 'Attach') . ' Hc Draft',
				['/hc-draft-tag/create', 'HcDraftTag' => ['hc_tag_id' => $model->id]],
				['class' => 'btn btn-info btn-xs']
			) ?>
		</div>
	</div>
	<?php Pjax::begin(['id' => 'pjax-HcDrafts', 'enableReplaceState' => false, 'linkSelector' => '#pjax-HcDrafts ul.pagination a, th a']) ?>
	<?php echo
		'<div class="table-responsive">'
			. \yii\grid\GridView::widget([
				'layout' => '{summary}<div class="text-center">{pager}</div>{items}<div class="text-center">{pager}</div>',
				'dataProvider' => new \yii\data\ActiveDataProvider([
					'query' => $model->getHcDraftTags(),
					'pagination' => [
						'pageSize' => 20,
						'pageParam' => 'page-blogposttags',
					]
				]),
				'pager'        => [
					'class'          => yii\widgets\LinkPager::className(),
					'firstPageLabel' => Yii::t('cruds', 'First'),
					'lastPageLabel'  => Yii::t('cruds', 'Last')
				],
				'columns' => [
					// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
					[
						'class' => yii\grid\DataColumn::className(),
						'attribute' => 'hc_draft_id',
						'value' => function ($model) {
							if ($rel = $model->blogPost) {
								return Html::a($rel->name, ['/hc-draft/view', 'id' => $rel->id,], ['data-pjax' => 0]);
							} else {
								return '';
							}
						},
						'format' => 'raw',
					],
					'sort',
					[
						'class'      => 'yii\grid\ActionColumn',
						'template'   => '{view} {update}',
						'contentOptions' => ['nowrap' => 'nowrap'],
						'urlCreator' => function ($action, $model, $key, $index) {
							// using the column name as key, not mapping to 'id' like the standard generator
							$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
							$params[0] = '/hc-draft-tag' . '/' . $action;
							$params['HcDraftTag'] = ['hc_tag_id' => $model->primaryKey()[0]];
							return $params;
						},
						'buttons'    => [],
						'controller' => '/hc-draft-tag'
					],
				]
			])
			. '</div>'
	?>
	<?php Pjax::end() ?>
	<?php $this->endBlock() ?>

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
					'content' => $this->blocks['common\html_constructor\models\HcTag'],
					'active'  => true,
				],
				[
					'content' => $this->blocks['HcDrafts'],
					'label'   => '<small>Hc Drafts <span class="badge badge-default">' . $model->getHcDrafts()->count() . '</span></small>',
					'active'  => false,
				],
				[
					'content' => $this->blocks['Media'],
					'label'   => '<small>?????????? <span class="badge badge-default">' . $model->getFileTargets()->count() . '</span></small>',
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