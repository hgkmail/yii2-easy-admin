<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\form\RegisterForm */
/* @var $roles app\models\Role[] */
/* @var $userprofile \app\models\UserProfile */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . $model->getUser()->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getUser()->username, 'url' => ['view', 'id' => $model->getUser()->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
        'roles' => $roles,
        'userprofile' => $userprofile,
    ]) ?>

</div>
