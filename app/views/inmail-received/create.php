<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InmailReceived */

$this->title = Yii::t('app', 'Create Inmail Received');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inmail Receiveds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inmail-received-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
