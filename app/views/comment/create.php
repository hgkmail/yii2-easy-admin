<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $posts \app\models\Post[] */
/* @var $users \app\models\User[] */

$this->title = Yii::t('app', 'Create Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-create">

    <?= $this->render('_form', [
        'model' => $model,
        'posts' => $posts,
        'users' => $users,
    ]) ?>

</div>
