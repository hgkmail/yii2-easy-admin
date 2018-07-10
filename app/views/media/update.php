<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Media */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Media',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Media'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="media-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
