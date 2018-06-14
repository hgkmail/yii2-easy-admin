<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $menuList \app\models\Menu[] */
/* @var $selectedMenuList \app\models\Menu[] */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Role',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="role-update">

    <?= $this->render('_form', [
        'model' => $model,
        'menuList' => $menuList,
        'selectedMenuList' => $selectedMenuList,
    ]) ?>

</div>
