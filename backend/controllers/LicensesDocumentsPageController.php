<?php

namespace backend\controllers;

use Yii;
use backend\models\LicensesDocumentsPage;
use backend\models\LicensesDocumentsPageSearch;
use backend\models\LicensePageGalleries;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LicensesDocumentsPageController implements the CRUD actions for LicensesDocumentsPage model.
 */
class LicensesDocumentsPageController extends Controller
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
     * Lists all LicensesDocumentsPage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LicensesDocumentsPageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LicensesDocumentsPage model.
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
     * Creates a new LicensesDocumentsPage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LicensesDocumentsPage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LicensesDocumentsPage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->licenses_gallery_images = UploadedFile::getInstances($model, 'licenses_gallery_images');
            $model->documents_list = UploadedFile::getInstances($model, 'documents_list');

            $uploadFlagImages = $model->uploadImages();
            $uploadFlagDocuments = $model->uploadDocuments();

            if($uploadFlagImages && $uploadFlagDocuments){
                $model->save();
            }
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDeleteGalleryImage($event_id, $image_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $image = LicensePageGalleries::findOne($image_id);
        $path = 'images/uploaded/licensesDocumentsPage/licenses/' . $image->filepath;
        $thumbPath = 'images/uploaded/licensesDocumentsPage/licenses/' . 'thumbnail_' . $image->filepath;


        if (unlink($path) && unlink($thumbPath)) {
          $image->delete();
          return ['success' => 'Удалено'];
        }
        return ['error' => 'Ошибка загрузки'];
    }

    public function actionDeleteDocument($event_id, $doc_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $doc = LicensePageGalleries::findOne($doc_id);
        $path = 'images/uploaded/licensesDocumentsPage/documents/' . $doc->filepath;

        if (unlink($path)) {
          $doc->delete();
          return ['success' => 'Удалено'];
        }
        return ['error' => 'Ошибка загрузки'];
    }


    /**
     * Deletes an existing LicensesDocumentsPage model.
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
     * Finds the LicensesDocumentsPage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LicensesDocumentsPage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LicensesDocumentsPage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
