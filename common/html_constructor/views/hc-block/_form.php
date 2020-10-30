<?php

use common\html_constructor\models\BlockTypeEnum;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \yii\bootstrap\Tabs;
use yii\web\View;

/**
 *
 * @var yii\web\View $this
 * @var common\html_constructor\models\HcDraft $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="blog-block-form">

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

	<div class="">
		<?php $this->beginBlock('main'); ?>

		<p>
			<!-- attribute type -->
			<?php echo $form->field($model, 'type')->dropDownList(
				BlockTypeEnum::LABEL_MAP,
				[
					'prompt' => Yii::t('cruds', 'Select'),
				]
			); ?>

			<!-- attribute name -->
			<?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


			<!-- attribute alias -->
			<?php echo $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

			<!-- attribute template -->
			<?php echo $form->field($model, 'template')->widget(
				'trntv\aceeditor\AceEditor',
				[
					'mode' => 'handlebars',
					'theme' => 'textmate',
					'containerOptions' => ['style' => 'width: 100%; min-height: 400px; font-size: 14px']
				]
			); ?>

			<!-- attribute inputs -->
			<?php echo $form->field($model, 'inputs')->widget(
				'trntv\aceeditor\AceEditor',
				[
					'mode' => 'json',
					'theme' => 'chrome',
					'containerOptions' => ['style' => 'width: 100%; min-height: 200px; font-size: 14px']
				]
			); ?>
		</p>
		<?php $this->endBlock(); ?>

		<?php echo
			Tabs::widget(
				[
					'encodeLabels' => false,
					'items' => [
						[
							'label'   => Yii::t('models', 'HcDraft'),
							'content' => $this->blocks['main'],
							'active'  => true,
						],
					]
				]
			);
		?>
		<hr />

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

	</div>

</div>