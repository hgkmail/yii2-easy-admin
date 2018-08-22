<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $pages \app\models\Page[] */
/* @var $users \app\models\User[] */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Page',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="page-update">

    <?= $this->render('_form', [
        'model' => $model,
        'pages' => $pages,
        'users' => $users,
    ]) ?>

</div>
