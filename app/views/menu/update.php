<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $menus \app\models\Menu[] */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Menu',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="menu-update">

    <?= $this->render('_form', [
        'model' => $model,
        'menus' => $menus,
    ]) ?>

</div>
