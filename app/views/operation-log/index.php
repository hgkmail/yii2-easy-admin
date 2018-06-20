<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OperationLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Operation Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-log-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= \app\widgets\BatchDeleteButton::widget(['action' => '/operation-log/delete-batch']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'id' => 'grid',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => '\app\widgets\CustomCheckboxColumn'],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}',
                ],
                [
                    'attribute' => 'user.username',
                    'value' => function($model) {
                        if(empty($model->user)) {
                            return '[Inactivated]';
                        } else {
                            return $model->user->username;
                        }
                    }
                ],
                'ip',
                'description',
                'path',
                'created_at:datetime',
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
