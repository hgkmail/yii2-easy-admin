<?php

use app\models\User;
use app\models\UserProfile;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $userProfile UserProfile */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view box box-primary">
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
                'username',
                'email:email',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return $model->status == User::STATUS_ENABLED ? 'Enabled' : 'Disabled';
                    },
                ],
                'role.name',
                'created_at:date',
                'updated_at:date',
            ],
        ]) ?>
    </div>
</div>

<div class="user-view box box-success">
    <div class="box-header">Profile</div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $userProfile,
            'attributes' => [
                'nickname',
                [
                    'attribute' => 'gender',
                    'value' => function($model) {
                        if($model->gender== UserProfile::GENDER_FEMALE)
                            return 'Female';
                        else
                            return 'Male';
                    }
                ],
                [
                    'attribute' => 'avatar',
                    'format' => 'raw',
                    'value' => function($model) {
                        return "<img src='$model->avatar' alt='avatar' width='150' height='150'>";
                    }
                ],
                'phone_number',
                'birthday:date',
                'description:html',
            ]
        ]) ?>
    </div>
</div>

