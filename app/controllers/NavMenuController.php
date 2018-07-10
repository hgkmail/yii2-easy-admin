<?php

namespace app\controllers;

use app\models\NavMenuItem;
use Yii;
use app\models\NavMenu;
use app\models\search\NavMenuSearch;
use yii\bootstrap\Nav;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NavMenuController implements the CRUD actions for NavMenu model.
 */
class NavMenuController extends Controller
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
     * Lists all NavMenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NavMenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NavMenu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new NavMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NavMenu();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->item_tree = json_decode($model->item_tree, true);
            $model->save();
            $this->saveMenuItem($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing NavMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $menuItems = $model->getNavMenuItems()->asArray(true)->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->item_tree = json_decode($model->item_tree, true);
            $model->save();
            $this->saveMenuItem($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'menuItems' => $menuItems,
            ]);
        }
    }

    /**
     * Deletes an existing NavMenu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NavMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NavMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NavMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param NavMenu $model
     */
    public function saveMenuItem($model)
    {
        Yii::$app->db->createCommand()
            ->delete('{{%nav_menu_item}}', 'menu_id=:id', [':id' => $model->id])
            ->execute();

        $items = Yii::$app->request->post('nav_menu_items');
        if(empty($items))
            return;

        foreach ($items as $item) {
            if(empty($items))
                continue;
            $json = json_decode($item, true);
            if(empty($json))
                continue;
            $menuItem = new NavMenuItem();
            $menuItem->menu_id = $model->id;
            foreach ($json as $key => $value) {
                $menuItem->$key = $value;
            }
            $menuItem->save();
        }

    }




}
