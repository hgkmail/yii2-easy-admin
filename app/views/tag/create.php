<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tag */

$this->title = Yii::t('app', 'Create Tag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
