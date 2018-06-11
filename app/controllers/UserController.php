<?php

namespace app\controllers;

use app\models\form\RegisterForm;
use app\models\Role;
use app\models\UserProfile;
use app\services\OptionService;
use dmstr\widgets\Alert;
use Yii;
use app\models\User;
use app\models\search\UserSearch;
use yii\base\InvalidArgumentException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $roles = Role::find()->all();
        $optionService = Yii::$app->get('optionService');
        $gridSetting = $optionService->getGridCols(Yii::$app->requestedRoute);

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridSetting' => $gridSetting,
            'roles' => $roles,
        ]);
    }

    public function actionPick()  // don't need grid setting
    {
        $roles = Role::find()->all();
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = 'main-pick';
        return $this->render('pick', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'roles' => $roles,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws
     */
    public function actionView($id)
    {
        $user = $this->findModel($id);
        $userProfile = $user->userProfile;
        if (empty($userProfile)) {
           $userProfile = new UserProfile();
           $userProfile->user_id = $user->id;
        }
        return $this->render('view', [
            'model' => $user,
            'userProfile' => $userProfile
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RegisterForm(['scenario' => RegisterForm::SCENARIO_CREATE]);
        $roles = Role::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->validateUsername()) {
            $newUser = $model->createUser();
            Yii::$app->session->addFlash('success', "User $newUser->username is created successfully.");
            return $this->redirect(['view', 'id' => $newUser->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'roles' => $roles,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $roles = Role::find()->all();
        $model = new RegisterForm(['scenario' => RegisterForm::SCENARIO_UPDATE]);
        $model->setUser($user);

        $userprofile = $user->getUserProfile()->one();
        if (empty($userprofile)) {
            $userprofile = new UserProfile();
            $userprofile->user_id = $user->id;
        }

        $post = Yii::$app->request->post();
        if ($model->load($post) && $userprofile->load($post)
            && $model->validate() && $model->validateUsername() && $userprofile->validate()) {

            $model->updateUser();
            $userprofile->save();
            Yii::$app->session->addFlash('success', "User $user->username is updated successfully.");
            return $this->redirect(['view', 'id' => $model->getUser()->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'roles' => $roles,
                'userprofile' => $userprofile,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteBatch()
    {
        $ids = Yii::$app->request->get('ids');
        if (empty($ids)) {
            throw new InvalidArgumentException('ids is empty');
        }
//        User::deleteAll(['in', 'id', $ids]);
        foreach($ids as $id) {
            $this->findModel($id)->delete();    // delete will trigger event, deleteAll will not.
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
