<?php

namespace backend\controllers;

use Yii;
use backend\models\Deals;
use backend\models\DealsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DealsController implements the CRUD actions for Deals model.
 */
class DealsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Deals models.
     * @return mixed
     */
    public function actionIndex()
    {
        // return 1;
        $searchModel = new DealsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Deals model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Deals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Deals();

        if ($model->load(Yii::$app->request->post()) &&  $model->save()) {

            return $this->redirect(['update', 'id' => $model->deals_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Deals model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if (!empty($model->small_image)) {
                $this->actionDeleteFrontImage($model->deals_id);
            };

            if (!empty($model->full_image)) {
                $this->actionDeleteBackImage($model->deals_id);
            };

            $model->small_image = UploadedFile::getInstances($model, 'small_image');
            $model->full_image = UploadedFile::getInstances($model, 'full_image');

            $uploadFlag = $model->uploadImage();
            if($uploadFlag){
                $model->save();
            }
            else{
                print_r($uploadFlag);
                exit;
            }
            return $this->redirect(['update', 'id' => $model->deals_id]);      
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDeleteBackImage($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if ($model->deals_image_back !== '') {

            $path = 'images/uploaded/deals/'. $id . '/' . $model->deals_image_back;
    
            if (unlink($path)) {
              $model->deals_image_back = '';
              $model->save();
              return ['success' => 'Удалено'];
            }
            return ['error' => 'Ошибка загрузки'];
        }
    }

    public function actionDeleteFrontImage($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if ($model->deals_image_front !== '') {

            $path = 'images/uploaded/deals/'. $id . '/' . $model->deals_image_front;
    
            if (unlink($path)) {
              $model->deals_image_front = '';
              $model->save();
              return ['success' => 'Удалено'];
            }
            return ['error' => 'Ошибка загрузки'];
        }
    }

    /**
     * Deletes an existing Deals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Deals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Deals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deals::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
