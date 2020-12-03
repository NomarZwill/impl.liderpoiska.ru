<?php

namespace backend\controllers;

use Yii;
use backend\models\Clinics;
use backend\models\ClinicsSearch;
use backend\models\ImageGalleries;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ClinicsController implements the CRUD actions for Clinics model.
 */
class ClinicsController extends Controller
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
     * Lists all Clinics models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClinicsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clinics model.
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
     * Creates a new Clinics model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clinics();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->clinic_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Clinics model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->cinic_gallery_images = UploadedFile::getInstances($model, 'cinic_gallery_images');
            $uploadFlag = $model->uploadImages();
            if($uploadFlag){
                $model->save();
            }

            return $this->redirect(['update', 'id' => $model->clinic_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDeleteGalleryImage($event_id, $image_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $image = ImageGalleries::findOne($image_id);
        $path = $image->filepath;

        ImageGalleries::updateSortIndex($event_id, $image->img_sort);

        if (unlink($path)) {
          $image->delete();
          return ['success' => 'Удалено'];
        }
        return ['error' => 'Ошибка загрузки'];
    }

    public function actionAjaxDragfile()
    {
        $currentImageID = $_POST['previewId'];
        $newIndex = $_POST['newIndex'];
        $oldIndex = $_POST['oldIndex'];
        $stack = $_POST['stack'];
        $imageClinicID = explode('/', $stack[$_POST['newIndex']]['url'])[2];

        $log = '';

        $images = ImageGalleries::find()
            ->where(['parent_id' => $imageClinicID, 'parent_type' => 'clinics'])
            ->all();

        if ($newIndex > $oldIndex) {

            $log .= 'moving forward; ';

            foreach ($images as $image){
                $log .= '$image->img_sort = ' . $image->img_sort . '; ';
                if ($image->img_sort > $oldIndex && $image->img_sort <= $newIndex){
                    $log .= 'notCurrentChange; ';
                    $image->img_sort = $image->img_sort - 1;
                    $image->save();
                } elseif ($image->img_sort == $oldIndex) {
                    $log .= 'currentImage change sort index; ';
                    $image->img_sort = $newIndex;
                    $image->save();
                }
            }

        } elseif ($newIndex < $oldIndex) {

            $log .= 'moving back; ';

            foreach ($images as $image){
                $log .= '$image->img_sort = ' . $image->img_sort . '; ';
                if ($image->img_sort >= $newIndex && $image->img_sort < $oldIndex){
                    $log .= 'notCurrentChange; ';
                    $image->img_sort = $image->img_sort + 1;
                    $image->save();
                } elseif ($image->img_sort == $oldIndex) {
                    $log .= 'currentImage change sort index; ';
                    $image->img_sort = $newIndex;
                    $image->save();
                }
            }
        }

        return json_encode([
            'currentImageID' => $currentImageID,
            'imageClinicID' => $imageClinicID,
            'log' => $log,
        ]);
    }


    /**
     * Deletes an existing Clinics model.
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
     * Finds the Clinics model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clinics the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clinics::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
