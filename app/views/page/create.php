<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $pages \app\models\Page[] */
/* @var $users \app\models\User[] */

$this->title = Yii::t('app', 'Create Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

    <?= $this->render('_form', [
        'model' => $model,
        'pages' => $pages,
        'users' => $users,
    ]) ?>

</div>
