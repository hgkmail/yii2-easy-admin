<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inmail */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Inmail',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inmails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="inmail-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
