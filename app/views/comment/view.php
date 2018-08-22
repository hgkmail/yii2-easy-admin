<?php

use app\models\Comment;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="comment-view box box-primary">
    <div class="box-header">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'post.title',
                'user.username',
                'title',
                [
                    'attribute' => 'content',
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        $statusDict = [];
                        $statusDict[Comment::STATUS_PENDING]="Pending";
                        $statusDict[Comment::STATUS_REVIEWED]="Reviewed";
                        $statusDict[Comment::STATUS_SPAM]="Spam";
                        return $statusDict[$model->status];
                    },
                ],
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>
