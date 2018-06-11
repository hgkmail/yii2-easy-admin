<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Feedback */

$this->title = Yii::t('app', 'Create Feedback');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feedbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
