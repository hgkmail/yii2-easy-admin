<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Like */
/* @var $posts \app\models\Post[] */
/* @var $users \app\models\User[] */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Like',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Likes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="like-update">

    <?= $this->render('_form', [
        'model' => $model,
        'posts' => $posts,
        'users' => $users,
    ]) ?>

</div>
