<?php

namespace app\controllers;

use app\models\Category;
use app\models\Tag;
use Yii;
use app\models\Post;
use app\models\search\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
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
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $allTags = Tag::find()->active()->all();
        $allCats = Category::find()->active()->all();

        $model = new Post();
        $model->author_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // tag and category
            $this->saveTagsAndCats($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'allTags' => $allTags,
                'allCats' => $allCats,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $allTags = Tag::find()->active()->all();
        $allCats = Category::find()->active()->all();

        $model = $this->findModel($id);
        $hasTags = $model->tags;
        $hasCats = $model->categories;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // tag and category
            $this->saveTagsAndCats($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'allTags' => $allTags,
                'allCats' => $allCats,
                'hasTags' => $hasTags,
                'hasCats' => $hasCats,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $model Post
     */
    private function saveTagsAndCats($model)
    {
        $postTags = explode(',', Yii::$app->request->post('post-tags'));
        Yii::$app->db->createCommand()->delete('{{%tag_post}}', ['post_id' => $model->id])->execute();
        foreach ($postTags as $tag) {
            Yii::$app->db->createCommand()
                ->insert('{{%tag_post}}', ['post_id' => $model->id, 'tag_id' => $tag])
                ->execute();
        }

        $postCats = explode(',', Yii::$app->request->post('post-cats'));
        Yii::$app->db->createCommand()->delete('{{%category_post}}', ['post_id' => $model->id])->execute();
        foreach ($postCats as $cat) {
            Yii::$app->db->createCommand()
                ->insert('{{%category_post}}', ['post_id' => $model->id, 'category_id' => $cat])
                ->execute();
        }
    }
}
