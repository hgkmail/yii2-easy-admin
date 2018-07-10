<?php


/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $model app\models\Tag */
/* @var $form yii\widgets\ActiveForm */

$statusItems = [1 => 'Enabled', 2 => 'Disabled'];
?>

<div class="tag-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'desc')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'status', ['inline' => true])->radioList($statusItems,
            ['itemOptions' => ['labelOptions' => ['class' => 'text-black']]]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
