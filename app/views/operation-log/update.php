<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OperationLog */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Operation Log',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operation Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="operation-log-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
