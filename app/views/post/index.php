<?php

use app\models\Post;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;

function outputTags($tags) {
    $result = '';
    foreach ($tags as $idx=>$tag) {
        if($idx!=0)
            $result.=', ';
        $result.=$tag->name;
    }
    return $result;
}

?>
<div class="post-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => '\app\widgets\CustomCheckboxColumn'],
                ['class' => 'yii\grid\ActionColumn'],
                'title',
                [
                    'attribute' => 'author',
                    'value' => 'author.username',
                ],
                [
                    'attribute' => 'tags',
                    'label' => 'Tags',
                    'value' => function($model) {
                        return outputTags($model->tags);
                    }
                ],
                [
                    'attribute' => 'categories',
                    'label' => 'Categories',
                    'value' => function($model) {
                        return outputTags($model->categories);
                    }
                ],
                [
                    'attribute' => 'status',
                    'filter' => [Post::STATUS_PUBLISH => 'Publish', Post::STATUS_PENDING_REVIEW => 'Pending Review',
                                 Post::STATUS_DRAFT => 'Draft'],
                    'value' => function($model) {
                        switch ($model->status) {
                            case Post::STATUS_DRAFT: return 'Draft';
                            case Post::STATUS_PENDING_REVIEW: return 'Pending Review';
                            case Post::STATUS_PUBLISH: return 'Publish';
                        }
                    }
                ],
//                [
//                    'attribute' => 'visibility',
//                    'filter' => [Post::VISIBILITY_PRIVATE => 'Private', Post::VISIBILITY_PUBLIC => 'Public'],
//                    'value' => function($model) {
//                        return $model->visibility== Post::VISIBILITY_PUBLIC?'Public':'Private';
//                    }
//                ],
//                [
//                    'attribute' => 'commentStatus',
//                    'filter' => [Post::COMMENT_OPEN => 'Open', Post::COMMENT_CLOSE => 'Close'],
//                    'value' => function($model) {
//                        return $model->commentStatus== Post::COMMENT_OPEN?'Open':'Close';
//                    }
//                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
