<?php

use common\html_constructor\assets\Constructor;
use common\html_constructor\models\HcTag;
use common\html_constructor\widgets\DateTimePicker;
use common\html_constructor\widgets\HtmlEditor;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;

/**
 *
 * @var yii\web\View $this
 * @var common\html_constructor\models\HcDraft $model
 * @var yii\widgets\ActiveForm $form
 */

Constructor::register($this);

?>

<div class="hc-draft-form" data-ctor-draft-id="<?= $model->id ?>" data-ctor-preview-link="<?= \Yii::$app->params['getPreviewLink']($model->id) ?>" data-ctor-save-link="<?= '/hc-draft/' . $model->id . '/save/' ?>">

	<?php $this->beginBlock('main'); ?>

	<?php $form = ActiveForm::begin([
		'id' => 'HcDraft',
		'layout' => 'horizontal',
		'enableClientValidation' => true,
		'errorSummaryCssClass' => 'error-summary alert alert-danger',
		'fieldConfig' => [
			'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
			'horizontalCssClasses' => [
				'label' => 'col-sm-2',
				//'offset' => 'col-sm-offset-4',
				'wrapper' => 'col-sm-8',
				'error' => '',
				'hint' => '',
			],
		],
	]);
	?>

	<div class="form-group mti-20 mbi-20">
		<label class="control-label col-sm-2">Выбрать тэги</label>
		<div class="col-sm-8 flex_wrap">
			<?php if ($model->isNewRecord) : ?>
				можно после сохранения
			<?php else : ?>
				<?= Select2::widget([
					'name' => 'hcDraftTags',
					'data' => ArrayHelper::map(HcTag::find()->all(), 'id', 'name'),
					'value' => array_map(function ($tag) {
						return $tag->hc_tag_id;
					}, $model->hcDraftTags),
					'maintainOrder' => true,
					'options' => [
						'placeholder' => 'Выберите тэги',
						'multiple' => true,
					],
				]);
				?>
			<?php endif; ?>
		</div>
	</div>


	<!-- attribute name -->
	<?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<!-- attribute alias -->
	<?php echo $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

	<!-- attribute intro -->
	<?php echo $form->field($model, 'intro')->widget(HtmlEditor::class) ?>

	<?php echo $form->field($model, 'short_intro')->textarea() ?>

	<!-- attribute published -->
	<?php echo $form->field($model, 'published')->checkbox([], false) ?>

	<!-- attribute featured -->
	<?php echo $form->field($model, 'featured')->checkbox([], false) ?>

	<?php echo $form->field($model, 'published_at')->widget(DateTimePicker::class) ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo Html::submitButton(
		'<span class="glyphicon glyphicon-check"></span> ' .
			($model->isNewRecord ? Yii::t('cruds', 'Create') : Yii::t('cruds', 'Save')),
		[
			'id' => 'save-' . $model->formName(),
			'class' => 'btn btn-success'
		]
	);
	?>

	<?php ActiveForm::end(); ?>

	<?php $this->endBlock(); ?>

	<?php $this->beginBlock('constructor');
	if ($model->isNewRecord) : ?>
		<div class="callout callout-warning mt-20">Сохранитe драфт чтобы загрузить конструктор</div>
	<?php else : ?>
		<div class="" id="react-constructor"></div>
	<?php endif; ?>
	<?php $this->endBlock(); ?>

	<?php $this->beginBlock('Media');

	echo $this->render('@common/html_constructor/views/media_tab_form.php', ['model' => $model]);

	$this->endBlock() ?>

	<?php $this->beginBlock('Seo');

	echo $this->render('@common/html_constructor/views/seo_tab_form.php', ['model' => $model]);

	$this->endBlock() ?>


	<?php echo
		Tabs::widget(
			[
				'encodeLabels' => false,
				'items' => [
					// [
					// 	'label'   => Yii::t('models', 'HcDraft'),
					// 	'content' => $this->blocks['main'],
					// 	'active'  => false,
					// ],
					// [
					// 	'content' => $this->blocks['Media'],
					// 	'label'   => '<small>Файлы <span class="badge badge-default">' . $model->getFileTargets()->count() . '</span></small>',
					// 	'active'  => false,
					// ],
					// [
					// 	'content' => $this->blocks['Seo'],
					// 	'label'   => '<small>SEO<span class="badge badge-default"></span></small>',
					// 	'active'  => false,
					// ],
					[
						'label'   => 'Конструктор',
						'content' => $this->blocks['constructor'],
						'active'  => true,
					],
				]
			]
		);
	?>
</div>