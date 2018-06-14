<?php

namespace app\controllers;

use app\models\Menu;
use app\services\MainMenuService;
use Yii;
use app\models\Role;
use app\models\search\RoleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
{
    /* @var $mainMenuService MainMenuService */
    public $mainMenuService;

    public function init()
    {
        parent::init();
        $this->mainMenuService = Yii::$app->get('mainMenuService');
    }

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
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $menuList = Menu::find()->defaultOrder()->all();
        $selectedMenuList = $model->menus;
        // include parent of selected nodes
        $menuList = $this->mainMenuService->includeParent($menuList, $selectedMenuList);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'menuList' => $menuList,
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->type = Role::TYPE_ROLE;
            $model->save();
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $menuList = Menu::find()->defaultOrder()->all();
        $selectedMenuList = $model->menus;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            // update table {{%role_menu}}
            $treeSelected = Yii::$app->request->post('tree-selected');
            $ids = explode(',', $treeSelected);
            $model->saveRoleMenu($ids);

            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'menuList' => $menuList,
                'selectedMenuList' => $selectedMenuList,
            ]);
        }
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $builtin = ['admin' => 1, 'author' => 1, 'contributor' => 1, 'editor' => 1, 'subscriber' => 1];

        $model = $this->findModel($id);
        if(array_key_exists($model->name, $builtin)) {
            Yii::$app->session->addFlash('error', 'Can not delete builtin roles.');
        } else {
            $model->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
