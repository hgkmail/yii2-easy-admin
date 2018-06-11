<?php

namespace app\controllers;

use app\base\ExceptionFilter;
use app\base\UploadAction;
use app\models\form\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'exceptionFilter' => [
                'class' => ExceptionFilter::class,
                'only' => ['error'],
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'grid-setting' => [
                'class' => 'app\base\GridSettingAction',
            ],
            'upload' => [
                'class' => UploadAction::class,
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTestAdminlte()
    {
        Yii::$app->session->addFlash('info', "Your message to display");
        Yii::$app->session->addFlash('error', "abc");
        return $this->render('test-adminlte');
    }

    public function actionRegister()
    {
        $model  = new RegisterForm(['scenario' => RegisterForm::SCENARIO_REGISTER]);
        if($model->load(Yii::$app->request->post()) && $model->validate() && $model->validateUsername()) {
            $model->register();
            $this->redirect('login');
        }
        else {
            $this->layout = 'main-login';
            return $this->render('register', [
                'model' => $model
            ]);
        }
    }

    public function actionBox()
    {
        sleep(2);
        return 'name: '.Yii::$app->getRequest()->get('name').', time: '.date('Y-m-d H-i-s');
    }

    public function actionUploadAvatar()
    {
        $file = UploadedFile::getInstanceByName('croppedImage');
        if($file) {
            $file->saveAs(Yii::getAlias('@webroot')."/upload/avatar/$file->baseName.$file->extension");
        }
    }
}
