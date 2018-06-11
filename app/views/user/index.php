<?php

use app\models\User;
use app\widgets\BatchDeleteButton;
use app\widgets\GridSettingModal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $gridSetting array */
/* @var $roles \app\models\Role[] */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;

$roleNames = [];
array_walk($roles, function ($role, $idx) use(&$roleNames) {
    $roleNames[$role->name] = $role->name;
});

// default grid setting
$gridSetting = $gridSetting == null ? ['email', 'role'] : $gridSetting;
?>
<div class="user-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
        <?= BatchDeleteButton::widget(['action' => '/user/delete-batch']) ?>
        <div class="pull-right box-tools">
            <button class="btn btn-primary" data-toggle="modal" data-target="#grid-setting"><i class="fa fa-cog"></i></button>
        </div>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id' => 'grid',
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],
                [
                    'class' => '\yii\grid\CheckboxColumn',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                ],
                'username',
                ['attribute' => 'email', 'format' => 'email', 'visible' => in_array('email', $gridSetting)],
                ['attribute' => 'role', 'value' => 'role.name', 'filter' => $roleNames,
                    'visible' => in_array('role', $gridSetting),
                ],
                ['attribute' => 'status', 'visible' => in_array('status', $gridSetting),
                    'filter' => [User::STATUS_ENABLED => 'Enabled', User::STATUS_DISABLED => 'Disabled'],
                    'value' => function($model, $key, $index, $column) {
                        return $model->status == User::STATUS_ENABLED ? 'Enabled' : 'Disabled';
                    }
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

    <?= GridSettingModal::widget([
            'modalId' => 'grid-setting',
            'searchModel' => $searchModel,
            'optAttributes' => ['email', 'role', 'status'],
            'gridSetting' => $gridSetting,
    ]) ?>

    <?php Pjax::end(); ?>
</div>
