<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-7-4
 * Time: 下午4:27
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form ActiveForm */

?>

<div class="post-form box box-solid box-no-shadow">
    <div class="box-body table-responsive">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->widget(\app\widgets\CustomTinyMce::class, [
            'options' => ['row' => 10, 'id' => 'tiny-editor'],
        ]) ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
</div>
