<?php

namespace common\html_constructor\controllers;

use common\html_constructor\models\HcBlock;
use yii\bootstrap\Tabs;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/**
 * HcBlockController implements the CRUD actions for HcBlock model.
 */
class HcBlockController extends BaseHcController
{
	
	/**
	 *
	 * @var boolean whether to enable CSRF validation for the actions in this controller.
	 * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
	 */
	public $enableCsrfValidation = false;

	public function behaviors()
	{
		return [
		];
	}

	/**
	 * Lists all HcBlock models.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		Url::remember();
		\Yii::$app->session['__crudReturnUrl'] = null;

		$dataProvider = new ActiveDataProvider([
				'query' => HcBlock::find(),
			]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}


	/**
	 * Displays a single HcBlock model.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		\Yii::$app->session['__crudReturnUrl'] = Url::previous();
		Url::remember();

		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}


	/**
	 * Creates a new HcBlock model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new HcBlock;

		try {
			if ($model->load($_POST) && $model->save()) {
				\Yii::$app->session->setFlash('success', 'Объект создан, можно загружать файлы');

				return $this->redirect(['update', 'id' => $model->id]);
			} elseif (!\Yii::$app->request->isPost) {
				$model->load($_GET);
			}
		} catch (\Exception $e) {
			$msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
			$model->addError('_exception', $msg);
		}
		return $this->render('create', ['model' => $model]);
	}


	/**
	 * Updates an existing HcBlock model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}


	/**
	 * Deletes an existing HcBlock model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		try {
			$this->findModel($id)->delete();
		} catch (\Exception $e) {
			$msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
			\Yii::$app->getSession()->addFlash('error', $msg);
			return $this->redirect(Url::previous());
		}


		// TODO: improve detection
		$isPivot = strstr('$id', ',');
		if ($isPivot == true) {
			return $this->redirect(Url::previous());
		} elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
			Url::remember(null);
			$url = \Yii::$app->session['__crudReturnUrl'];
			\Yii::$app->session['__crudReturnUrl'] = null;

			return $this->redirect($url);
		} else {
			return $this->redirect(['index']);
		}
	}


	/**
	 * Finds the HcBlock model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @throws HttpException if the model cannot be found
	 * @param integer $id
	 * @return HcBlock the loaded model
	 */
	protected function findModel($id)
	{
		if (($model = HcBlock::findOne($id)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
