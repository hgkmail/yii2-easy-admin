<?php

namespace app\controllers;

use app\models\form\RegisterForm;
use app\services\OptionService;
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
                'class' => VerbFilter::className(),
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
        $optionService = Yii::$app->get('optionService');
        $gridSetting = $optionService->getGridCols(Yii::$app->requestedRoute);

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridSetting' => $gridSetting,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->validateUsername()) {
            $newUser = $model->createUser();
            return $this->redirect(['view', 'id' => $newUser->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
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
        $model = new RegisterForm(['scenario' => RegisterForm::SCENARIO_UPDATE]);
        $model->setUser($user);

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->validateUsername()) {
            $model->updateUser();
            return $this->redirect(['view', 'id' => $model->getUser()->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
        if ($ids == null) {
            throw new InvalidArgumentException('ids is null');
        }
        User::deleteAll(['in', 'id', $ids]);
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
