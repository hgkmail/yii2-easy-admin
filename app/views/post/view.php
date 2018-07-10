<?php

use app\models\Post;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

function outputTags($tags, $style) {
    if(empty($tags)) {
        return '[empty]';
    } else {
        $result = '';
        foreach ($tags as $tag) {
            $result.="<span class='label label-$style post-tag-label'>{$tag->name}</span>";
        }
        return $result;
    }
}

?>
<div class="post-view box box-primary">
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
                'title',
                'author.username',
                [
                    'attribute' => 'tags',
                    'label' => 'Tags',
                    'format' => 'raw',
                    'value' => function($model) {
                        return outputTags($model->tags, 'primary');
                    }
                ],
                [
                    'attribute' => 'categories',
                    'label' => 'Categories',
                    'format' => 'raw',
                    'value' => function($model) {
                        return outputTags($model->categories, 'success');
                    }
                ],
                'content:raw',
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        switch ($model->status) {
                            case Post::STATUS_DRAFT: return 'Draft';
                            case Post::STATUS_PENDING_REVIEW: return 'Pending Review';
                            case Post::STATUS_PUBLISH: return 'Publish';
                        }
                    }
                ],
                [
                    'attribute' => 'visibility',
                    'value' => function($model) {
                        return $model->visibility== Post::VISIBILITY_PUBLIC?'Public':'Private';
                    }
                ],
                [
                    'attribute' => 'commentStatus',
                    'value' => function($model) {
                        return $model->commentStatus== Post::COMMENT_OPEN?'Open':'Close';
                    }
                ],
                [
                    'attribute' => 'cover',
                    'format' => 'raw',
                    'value' => function($model) {
                        $cover = $model->cover;
                        return "<img src='$cover' style='max-width: 100px;max-height: 100px;'>";
                    }
                ],
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>
