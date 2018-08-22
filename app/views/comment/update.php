<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $posts \app\models\Post[] */
/* @var $users \app\models\User[] */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Comment',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="comment-update">

    <?= $this->render('_form', [
        'model' => $model,
        'posts' => $posts,
        'users' => $users,
    ]) ?>

</div>
