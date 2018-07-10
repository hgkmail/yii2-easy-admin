<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NavMenuItem */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Nav Menu Item',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nav Menu Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="nav-menu-item-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
