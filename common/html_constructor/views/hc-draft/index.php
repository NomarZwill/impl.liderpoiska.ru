<?php

use common\html_constructor\models\BaseFileEnum;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
 *
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = Yii::t('models', 'Hc Drafts');
$this->params['breadcrumbs'][] = $this->title;
$fileEnumclass = BaseFileEnum::class;


if (isset($actionColumnTemplates)) {
	$actionColumnTemplate = implode(' ', $actionColumnTemplates);
	$actionColumnTemplateString = $actionColumnTemplate;
} else {
	Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New'), ['create'], ['class' => 'btn btn-success']);
	$actionColumnTemplateString = "{preview} {view} {update} {delete}";
}
$actionColumnTemplateString = '<div class="action-buttons">' . $actionColumnTemplateString . '</div>';
?>
<div class="giiant-crud hc-draft-index">

	<?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

	<h1>
		<?php echo Yii::t('models', 'Hc Drafts') ?>
		<small>
			список
		</small>
	</h1>
	<div class="clearfix crud-navigation">
		<div class="pull-left">
			<?php echo Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('cruds', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
		</div>

		<div class="pull-right">


			<?php echo
				\yii\bootstrap\ButtonDropdown::widget(
					[
						'id' => 'giiant-relations',
						'encodeLabel' => false,
						'label' => '<span class="glyphicon glyphicon-paperclip"></span> ' . Yii::t('cruds', 'Relations'),
						'dropdown' => [
							'options' => [
								'class' => 'dropdown-menu-right'
							],
							'encodeLabels' => false,
							'items' => [
								[
									'url' => ['/user/index'],
									'label' => '<i class="glyphicon glyphicon-arrow-left"></i> ' . Yii::t('models', 'User'),
								],
								[
									'url' => ['/user/index'],
									'label' => '<i class="glyphicon glyphicon-arrow-left"></i> ' . Yii::t('models', 'User'),
								],
								[
									'url' => ['/hc-draft-block/index'],
									'label' => '<i class="glyphicon glyphicon-arrow-right"></i> ' . Yii::t('models', 'Hc Draft Block'),
								],
								[
									'url' => ['/hc-draft-tag/index'],
									'label' => '<i class="glyphicon glyphicon-arrow-right"></i> ' . Yii::t('models', 'Hc Draft Tag'),
								],
								[
									'url' => ['/hc-tag/index'],
									'label' => '<i class="glyphicon glyphicon-arrow-right"></i> ' . Yii::t('models', 'Hc Tag'),
								],

							]
						],
						'options' => [
							'class' => 'btn-default'
						]
					]
				);
			?>
		</div>
	</div>

	<hr />

	<div class="table-responsive">
		<?php echo GridView::widget([
			'dataProvider' => $dataProvider,
			'pager' => [
				'class' => yii\widgets\LinkPager::className(),
				'firstPageLabel' => Yii::t('cruds', 'First'),
				'lastPageLabel' => Yii::t('cruds', 'Last'),
			],
			'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
			'headerRowOptions' => ['class' => 'x'],
			'columns' => [
				[
					'label' => 'Фото',
					'format' => 'image',
					'value' => function ($model) use ($fileEnumclass) {
						try {
							return $model->getFileData($fileEnumclass::IMAGE, ['height' => 80, 'width' => 100])->src;
						} catch (Exception $e) {
							//return $e;
						}
					}
				],
				'name',
				'alias',
				'short_intro:ntext',
				[
					'attribute' => 'published',
					'value' => function ($model, $index, $widget) {
						return $model->published
							? '<i class="fa fa-check fa-green fa-large"></i>'
							: '<i class="fa fa-close fa-red fa-large"></i>';
					},
					'format' => 'html',
					'filter' => [1 => 'Да', 0 => 'Нет'],

				],
				'published_at',
				/* [
				'attribute' => 'featured',
				'value' => function ($model, $index, $widget) {
					return $model->featured 
					?'<i class="fa fa-check fa-green fa-large"></i>'
					: '<i class="fa fa-close fa-red fa-large"></i>';
				},
				'format' => 'html',
				'filter' => [1 => 'Да', 0 => 'Нет'],

			], */
				// 'sort',
				// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
				[
					'class' => yii\grid\DataColumn::className(),
					'attribute' => 'created_by',
					'value' => function ($model) {
						if ($rel = $model->createdBy) {
							return Html::a($rel->email, ['/user/view', 'id' => $rel->id,], ['data-pjax' => 0]);
						} else {
							return '';
						}
					},
					'format' => 'raw',
				],
				/*// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
			[
			    'class' => yii\grid\DataColumn::className(),
			    'attribute' => 'updated_by',
			    'value' => function ($model) {
			        if ($rel = $model->updatedBy) {
			            return Html::a($rel->id, ['/user/view', 'id' => $rel->id,], ['data-pjax' => 0]);
			        } else {
			            return '';
			        }
			    },
			    'format' => 'raw',
			],*/
				[
					'class' => 'yii\grid\ActionColumn',
					'template' => $actionColumnTemplateString,
					'buttons' => [
						'view' => function ($url, $model, $key) {
							$options = [
								'title' => Yii::t('cruds', 'View'),
								'aria-label' => Yii::t('cruds', 'View'),
								'data-pjax' => '0',
							];
							return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
						},
						'preview' => function ($url, $model, $key) {
							$options = [
								'title' => 'Просмотр',
								'aria-label' => Yii::t('cruds', 'View'),
								'data-pjax' => '0',
								'target' => '_blank'
							];
							$url = \Yii::$app->params['getPreviewLink']($model->id);
							return Html::a('<span class="glyphicon glyphicon-new-window"></span>', $url, $options);
						}


					],
					'urlCreator' => function ($action, $model, $key, $index) {
						// using the column name as key, not mapping to 'id' like the standard generator
						$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
						$params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
						return Url::toRoute($params);
					},
					'contentOptions' => ['nowrap' => 'nowrap']
				],
			]
		]); ?>
	</div>

</div>


<?php \yii\widgets\Pjax::end() ?>