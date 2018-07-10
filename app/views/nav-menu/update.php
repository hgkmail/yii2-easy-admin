<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NavMenu */
/* @var $menuItems array */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Nav Menu',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nav Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="nav-menu-update">

    <?= $this->render('_form', [
        'model' => $model,
        'menuItems' => $menuItems,
    ]) ?>

</div>
