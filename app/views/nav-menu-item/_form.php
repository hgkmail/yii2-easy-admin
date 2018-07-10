<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NavMenuItem */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
$('#nav-menu-item-form').on('beforeSubmit', function(e) {
    return false;
});
JS;
$this->registerJs($js);

$js_global = <<<JS
// set
function setMenuItem(item) {
    $('#nav-menu-item-form')[0].reset();
    for(var key in item) {
        $("#nav-menu-item-form [name='"+key+"']").val(item[key]);
    }
}

// get
function getMenuItem() {
    var arr = $('#nav-menu-item-form').serializeArray();
    var result = {};
    for(var idx in arr) {
      var obj = arr[idx];
      if(obj.name!='_csrf') {
          result[obj.name] = obj.value;
      }
    }
    return result;
}
JS;
$this->registerJs($js_global, View::POS_END);

?>

<div class="nav-menu-item-form box box-default picker">
    <?php $form = ActiveForm::begin(['id' => 'nav-menu-item-form']); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'target')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'extra')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->textInput() ?>

        <?= Html::hiddenInput('id', '', ['id' => 'menu-item-id']) ?>

    </div>
    <?php ActiveForm::end(); ?>
</div>
