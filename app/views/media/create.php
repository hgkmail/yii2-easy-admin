<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Media */

$this->title = Yii::t('app', 'Create Media');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Media'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
