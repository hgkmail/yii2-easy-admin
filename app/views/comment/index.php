<?php

use app\models\Comment;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comments');
$this->params['breadcrumbs'][] = $this->title;

$statusDict = [];
$statusDict[Comment::STATUS_PENDING]="Pending";
$statusDict[Comment::STATUS_REVIEWED]="Reviewed";
$statusDict[Comment::STATUS_SPAM]="Spam";

?>
<div class="comment-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create Comment'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                [
                    'class' => '\yii\grid\CheckboxColumn',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                ],
                ['class' => 'yii\grid\ActionColumn'],
                'title',
                [
                    'attribute' => 'post',
                    'value' => 'post.title',
                ],
                [
                    'attribute' => 'user',
                    'value' => 'user.username',
                ],
                [
                    'attribute' => 'status',
                    'filter' => $statusDict,
                    'value' => function($model) {
                        $statusDict = [];
                        $statusDict[Comment::STATUS_PENDING]="Pending";
                        $statusDict[Comment::STATUS_REVIEWED]="Reviewed";
                        $statusDict[Comment::STATUS_SPAM]="Spam";
                        return $statusDict[$model->status];
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
