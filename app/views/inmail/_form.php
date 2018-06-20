<?php


/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $model \app\models\Inmail */
/* @var $form yii\widgets\ActiveForm */
/* @var $allUsers \app\models\User[] */

\app\assets\Select2Asset::register($this);

$receiverItems = [];
$curUserId = Yii::$app->user->id;
foreach ($allUsers as $user) {
    if ($user->id == $curUserId)
        continue;
    $receiverItems[$user->username] = $user->username;
}

$js = <<<JS
$('#receivers').select2({
    width: '100%',
    placeholder: "Select receivers",
});
JS;
$this->registerJs($js);

?>

<div class="inmail-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'receivers')->dropDownList($receiverItems,
            ['id' => 'receivers', 'class' => 'form-control', 'multiple' => "multiple"]) ?>

        <?= $form->field($model, 'subject')->textInput(['placeholder' => 'subject']) ?>

        <?= $form->field($model, 'content')->widget(\app\widgets\CustomTinyMce::class, [
            'options' => ['row' => 10, 'id' => 'tiny-editor'],
        ]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
