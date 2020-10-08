<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\MedicalSpecialties;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $data = file_get_contents('https://www.impl.ru/vyigruzka-dannyix/');
        
        // print_r($data);

        // $data = json_decode($data, true);

        // print_r($data);
        // print_r(count($data['doctors']));
            	
    	// exit;

    	// foreach ($data['medicalSpecialties'] as $key => $value) {
        //     if(!MedicalSpecialties::find()->where(['old_id' => $value['id']])->one()){
        //             $model = new MedicalSpecialties();
                    
        //             $model->specialty_title = $value['pagetitle'];
        //             $model->specialty_long_title = $value['longtitle'];
        //             $model->specialty_description = $value['description'];
        //             $model->introtext = $value['introtext'];
        //             $model->alias = $value['alias'];
        //             $model->menu_title = $value['menutitle'];
        //             $model->content = $value['content'];
        //             $model->speciality_review = $value['tv.review-to-special'];
        //             $model->head_text = $value['tv.head-text'];
        //             $model->price_title = $value['tv.price-title'];
        //             $model->review_title = $value['tv.review-title'];
        //             $model->faq_title = $value['tv.faq-title'];
        //             $model->medic_to_special = $value['tv.medic-to-special'];
        //             $model->query_to_service = $value['tv.query-to-service'];
        //             $model->price_to_service = $value['tv.price-to-service'];
        //             $model->keywords = $value['tv.keywords'];
        //       $model->old_id = $value['id'];
              // $model->date = strtotime($value['publishedon']);
          
        //     $model->save();
        //   }	 
        // }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
