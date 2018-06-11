<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Feedback */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Feedback',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feedbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="feedback-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
