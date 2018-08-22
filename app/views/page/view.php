<?php

use app\models\Page;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view box box-primary">
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
                    'attribute' => 'content',
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'cover',
                    'format' => 'raw',
                    'value' => function($model) {
                        $cover = $model->cover;
                        return "<img src='$cover' style='max-width: 100px;max-height: 100px;'>";
                    }
                ],
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        $statusDict=[];
                        $statusDict[Page::STATUS_DRAFT]='Draft';
                        $statusDict[Page::STATUS_PUBLISH]='Publish';
                        $statusDict[Page::STATUS_PENDING_REVIEW]='Pending Review';
                        return $statusDict[$model->status];
                    }
                ],
                [
                    'attribute' => 'visibility',
                    'value' => function($model) {
                        $visibilityDict=[];
                        $visibilityDict[Page::VISIBILITY_PUBLIC]='Public';
                        $visibilityDict[Page::VISIBILITY_PRIVATE]='Private';
                        return $visibilityDict[$model->visibility];
                    }
                ],
                'order',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>
