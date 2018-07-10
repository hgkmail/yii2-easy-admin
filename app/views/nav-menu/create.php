<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NavMenu */

$this->title = Yii::t('app', 'Create Nav Menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nav Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-menu-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
