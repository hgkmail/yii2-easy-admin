<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\LikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Likes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="like-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create Like'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
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
                [
                    'attribute' => 'post',
                    'value' => 'post.title',
                ],
                [
                    'attribute' => 'user',
                    'value' => 'user.username',
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
