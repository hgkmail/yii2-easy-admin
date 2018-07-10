<?php

namespace app\controllers;

use Yii;
use app\models\Media;
use app\models\search\MediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MediaController implements the CRUD actions for Media model.
 */
class MediaController extends Controller
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
     * Lists all Media models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Media model.
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
     * Creates a new Media model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Media();
        $path = Yii::$app->request->post('upload_path');
        $name = Yii::$app->request->post('file_name');
        $size = Yii::$app->request->post('file_size');
        if(empty($path)) {
            return $this->asJson(['code' => 400, 'msg' => 'path is empty']);
        }
        $model->upload_path = $path;
        $model->originName = $name;
        $model->title = pathinfo($name, PATHINFO_FILENAME);
        $model->size = $size;
        $model->setMIME(Yii::getAlias('@webroot').$path);
        $model->status = Media::STATUS_ENABLED;
        $model->visibility = Media::VISIBILITY_PUBLIC;
        if($model->save()) {
            return $this->asJson(['code' => 200, 'data' => $model->id]);
        } else {
            return $this->asJson(['code' => 500, 'msg' => 'save media fail']);
        }
    }

    /**
     * Updates an existing Media model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Media model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete()) {
            $file = Yii::getAlias('@webroot').$model->upload_path;
            if(file_exists($file)) {
                unlink($file);
            }
            $thumb = Yii::getAlias('@webroot').$model->thumb_path;
            if(!empty($model->thumb_path) && file_exists($thumb)) {
                unlink($thumb);
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Media model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Media the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Media::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
