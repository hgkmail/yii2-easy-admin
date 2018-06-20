<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OperationLog */

$this->title = Yii::t('app', 'Create Operation Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operation Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-log-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
