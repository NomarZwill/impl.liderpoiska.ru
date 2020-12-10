<?php

namespace backend\controllers;

use Yii;
use backend\models\Ratings;
use backend\models\RatingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RatingsController implements the CRUD actions for Ratings model.
 */
class RatingsController extends Controller
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
     * Lists all Ratings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RatingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ratings model.
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
     * Creates a new Ratings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ratings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ratings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // if (!empty($model->icon_img)) {
            //     $this->actionDeleteIcon($model->id);
            // };

            // $model->icon_img = UploadedFile::getInstances($model, 'icon_img');

            // $uploadFlag = $model->uploadImage();
            // if($uploadFlag){
            // $model->save();
            // }
            // else{
            //     print_r($uploadFlag);
            //     exit;
            // }

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    // public function actionDeleteIcon($id)
    // {
    //     Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    //     $model = $this->findModel($id);

    //     if ($model->icon !== '') {

    //         $path = 'images/uploaded/ratings/'. $id . '/' . $model->icon;
    
    //         if (unlink($path)) {
    //           $model->icon = '';
    //           $model->save();
    //           return ['success' => 'Удалено'];
    //         }
    //         return ['error' => 'Ошибка загрузки'];
    //     }
    // }

    /**
     * Deletes an existing Ratings model.
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
     * Finds the Ratings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ratings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ratings::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
