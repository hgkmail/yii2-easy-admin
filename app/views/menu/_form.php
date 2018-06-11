<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
/* @var $menus \app\models\Menu[] */

$menuWalker = new \app\base\MenuWalker();
$menuWalker->walk($menus, 100);
$menuItems = $menuWalker->items;

?>

<div class="menu-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'order')->textInput() ?>

        <?= $form->field($model, 'parent_id')->dropDownList($menuItems,
            ['encodeSpaces' => true, 'prompt' => '(no parent)']) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
