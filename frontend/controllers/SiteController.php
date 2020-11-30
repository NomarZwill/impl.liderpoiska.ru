<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use frontend\controllers\MainController;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\Deals;
use backend\models\Doctors;
use backend\models\Reviews;
use backend\models\Clinics;
use backend\models\Ratings;

/**
 * Site controller
 */
class SiteController extends MainController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            //'error' => [
            //    'class' => 'yii\web\ErrorAction',
            //],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionError(){

        $this->setSeo([
            'title' => 'Страница не найдена!',
            'desc' => '',
            'kw' => '',
        ]);

        return $this->render('404.twig');
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->setSeo([
            'title' => 'Эстетическая стоматология в центре Москвы. Центр Эстетической Стоматологии',
            'desc' => 'Центр Эстетической Стоматологии - профессиональная частная клиника в Москве. Все направления в стоматологии. Лучшие врачи. Доступные цены',
            'kw' => '',
        ]);

        $deals = Deals::find()
            ->where(['is_active' => 1])
            ->orderBy(['deals_sort' => SORT_ASC])
            ->all();
        $reviews = Reviews::find()->all();  
        $clinics = Clinics::find()
            ->where(['clinics.is_active' => 1])
            ->joinWith('ratings')
            ->all();
        $doctors = Doctors::find()
            ->where(['doctors.is_active' => 1, 'visible_on_home_page' => 1])
            ->joinWith('medicalSpecialties')
            ->all();  

        Doctors::modifyExperienceString($doctors);

        // Yii::$app->params['servises'] = Servises::find()->asArray()->all();

        // $data = json_decode(file_get_contents('https://www.impl.ru/vyigruzka-dannyix/'), TRUE);

        // foreach ($data['doctors'] as $key => $value) {
        // }
        // exit;

        return $this->render('index.twig', array(
            'deals' => $deals,
            'doctors' => $doctors,
            'reviews' => $reviews,
            'clinics' => $clinics,
        ));
    }

    public function actionAjaxClinicRating(){
        $clinic_id = $_GET['clinic_id'];
        $rating = Ratings::find()
            ->where(['clinic_id' => $clinic_id, 'is_active' => 1])
            ->all();
    
        return json_encode([
            'rating' => $this->renderPartial('/components/ratings.twig', array(
              'clinicRatings' => $rating,
            )),
          ]);
    }

    public function setSeo($seo){

        if (!empty($seo)) {
           $this->view->title = $seo['title'];
           $this->view->params['desc'] = $seo['desc'];
           $this->view->params['kw'] = $seo['kw'];
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
