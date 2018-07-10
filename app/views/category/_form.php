<?php


/* @var $this yii\web\View */
/* @var $parents \app\models\Category[] */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */

$walker = new \app\base\CommonWalker();
$walker->label_field = 'name';
$walker->walk($parents, 0);
$catItems = $walker->items;

$statusItems = [1 => 'Enabled', 2 => 'Disabled'];

?>

<div class="category-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'parent_id')->dropDownList($catItems,
            ['encodeSpaces' => true, 'prompt' => '(no parent)']) ?>

        <?= $form->field($model, 'status', ['inline' => true])->radioList($statusItems,
            ['itemOptions' => ['labelOptions' => ['class' => 'text-black']]]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
