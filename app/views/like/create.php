<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Like */
/* @var $posts \app\models\Post[] */
/* @var $users \app\models\User[] */

$this->title = Yii::t('app', 'Create Like');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Likes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="like-create">

    <?= $this->render('_form', [
        'model' => $model,
        'posts' => $posts,
        'users' => $users,
    ]) ?>

</div>
