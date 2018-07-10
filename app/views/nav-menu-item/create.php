<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NavMenuItem */

$this->title = Yii::t('app', 'Create Nav Menu Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nav Menu Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-menu-item-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
