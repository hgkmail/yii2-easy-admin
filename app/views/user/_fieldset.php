<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-10
 * Time: 上午4:02
 */

use app\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\form\RegisterForm */
/* @var $roles app\models\Role[] */

$reverse = array_reverse($roles);  // subscriber first
$roleNames = [];
array_walk($reverse, function ($role, $idx) use(&$roleNames) {
    $roleNames[$role->name] = $role->name;
});

$model->status = isset($model->status) ? $model->status : User::STATUS_ENABLED;

?>

<!-- basic box -->
<div class="user-form box box-solid box-no-shadow">
    <div class="box-body table-responsive">

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->textInput() ?>

        <?= $form->field($model, 'role')->dropDownList($roleNames, ['prompt' => 'Please select one role']) ?>

        <?= $form->field($model, 'status', ['inline' => true])->radioList([1 => 'Enabled', 2 => 'Disabled'],
            ['itemOptions' => ['labelOptions' => ['class' => 'text-black']]]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
</div>
