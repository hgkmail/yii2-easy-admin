<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InmailReceived */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inmail-received-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'sent_id')->textInput() ?>

        <?= $form->field($model, 'sender')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'receivers')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'receiver')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'read_at')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
