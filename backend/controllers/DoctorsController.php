<?php

namespace backend\controllers;

use Yii;
use backend\models\Doctors;
use backend\models\DoctorsSearch;
use backend\models\MedicalSpecialties;
use backend\models\Clinics;
use backend\models\DoctorsAndClinics;
use backend\models\DoctorsPageGalleries;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DoctorsController implements the CRUD actions for Doctors model.
 */
class DoctorsController extends Controller
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
     * Lists all Doctors models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DoctorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doctors model.
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
     * Creates a new Doctors model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Doctors();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->doctor_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Doctors model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //print_r($model->doctorsPageSort);
        //exit;

        if ($model->load(Yii::$app->request->post())) {

            $model->doctor_image_load = UploadedFile::getInstances($model, 'doctor_image_load');
            $model->doctor_lizcenz_gallery = UploadedFile::getInstances($model, 'doctor_lizcenz_gallery');

            if (!empty($model->doctor_image_load) && !empty($model->doctor_image)) {
                $this->actionDeleteImage($model->doctor_id);
            };
            
            $uploadFlag = $model->uploadImage();
            if($uploadFlag){
                $model->save();
            }
            else{
                print_r($uploadFlag);
                exit;
            }

            return $this->redirect(['update', 'id' => $model->doctor_id]);
        }

        // print_r($allSpecialtiesData);
        // exit;

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDeleteGalleryLizcenzImage($event_id, $image_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $image = DoctorsPageGalleries::findOne($image_id);
        $path = 'images/uploaded/doctors/'. $event_id . '/lizcenz/' . $image->filepath;

        if (unlink($path)) {
          $image->delete();
          return ['success' => 'Удалено'];
        }
        return ['error' => 'Ошибка загрузки'];
    }

    public function actionDeleteImage($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if ($model->doctor_image !== '') {

            $path = 'images/uploaded/doctors/'. $id . '/' . $model->doctor_image;
    
            // echo file_exists($path);
            // exit;
            if (!empty($model->doctor_image) && file_exists($path) === true){
                unlink($path);
                $model->doctor_image = '';
                $model->save();
                return ['success' => 'Удалено'];
            } elseif (!empty($model->doctor_image)) {
                $model->doctor_image = '';
                $model->save();
                return ['success' => 'Удалено'];
            }
            // if (unlink($path)) {
            //   $model->doctor_image = '';
            //   $model->save();
            //   return ['success' => 'Удалено'];
            // }  
            //     if (!empty($model->doctor_image)) {      //удалить после перезагрузки фото врачей
            //   $model->doctor_image = '';
            //   $model->save();
            //   return ['success' => 'Удалено'];
            // }
            return ['error' => 'Ошибка загрузки'];
        }
    }

    /**
     * Deletes an existing Doctors model.
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
     * Finds the Doctors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Doctors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        // if (($model = Doctors::findOne($id)) !== null) {
        //     return $model;
        // }

        $model = Doctors::find()
            ->joinWith('medicalSpecialties')
            ->joinWith('doctorsAndClinics')
            ->where(['doctors.doctor_id' => $id])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
