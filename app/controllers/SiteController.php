<?php

namespace app\controllers;

use app\base\ExceptionFilter;
use app\base\MyAuthHandler;
use app\base\oplog\LoginFilter;
use app\base\oplog\LogoutFilter;
use app\base\UploadAction;
use app\models\form\MenuTreeNode;
use app\models\form\RegisterForm;
use app\models\Menu;
use app\services\MainMenuService;
use app\widgets\MainMenu;
use Yii;
use yii\authclient\AuthAction;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
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
            ],
            'loginLog' => [
                'class' => LoginFilter::class,
                'only' => ['login'],
            ],
            'logoutLog' => [
                'class' => LogoutFilter::class,
                'only' => ['logout'],
            ],
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
            ],
            'auth' => [
                'class' => AuthAction::class,      // callback url - /site/auth
                'successCallback' => [$this, 'onAuthSuccess'],
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

        return $this->redirect('login');
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

    public function actionTestWidget()
    {
        return $this->render('test-widget');
    }

    public function actionTestUploadex()
    {
        return $this->render('test-uploadex');
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

    public function actionTestMenu()
    {
        /* @var $mainMenuService MainMenuService */
        $mainMenuService = Yii::$app->get('mainMenuService');

        $role = Yii::$app->user->identity->role;
        $menuList = Menu::find()->defaultOrder()->all();
        $selectedMenuList = $role->menus;
        $menuList = $mainMenuService->includeParent($menuList, $selectedMenuList);
        $nodeList = $mainMenuService->convertTree(MenuTreeNode::toNodeList($menuList));
        foreach ($nodeList as $i => $menu) {
            $url = $menu['url'][0];
            $visible = $menu['visible'];
            echo "$i-$url-$visible<br>";
        }
        echo $html = MainMenu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
            'items' => $nodeList,
        ]);
    }

    /** request a code */
    public function actionTestOauth2Client()
    {
        return $this->render('test-oauth2-client');
    }

    /** receive a code */
    public function actionCallback()
    {
        $code = Yii::$app->request->get('code');
        $clientId = Yii::$app->params['github_client_id'];
        $clientSecret = Yii::$app->params['github_client_secret'];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://github.com/login/oauth/access_token');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $fields = "client_id=$clientId&client_secret=$clientSecret&code=$code&accept=json";
        curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
        $output = curl_exec($curl);
        curl_close($curl);

        parse_str($output, $result);
        if(isset($result['access_token'])) {
            $accessToken = $result['access_token'];
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api.github.com/user?access_token=$accessToken");
            // user agent is necessary
            curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 5_0 like Mac OS X) 
                AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9A334 Safari/7534.48.3"));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($curl);
            return $output;
        } else {
            return 'Fail to get access token from Github';
        }
    }

    public function onAuthSuccess($client)
    {
        (new MyAuthHandler($client))->handle();
    }
}
