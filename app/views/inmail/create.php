<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\Inmail */
/* @var $allUsers \app\models\User[] */

$this->title = Yii::t('app', 'Send Inmail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sent'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inmail-create">

    <?= $this->render('_form', [
        'model' => $model,
        'allUsers' => $allUsers,
    ]) ?>

</div>
