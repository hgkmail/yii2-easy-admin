<?php

use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
\app\assets\StarRatingAsset::register($this);

$js = <<<JS
$("#star-rating").rating({'step': 1, 'hoverChangeStars': false, 'showClear':false, 'showCaption': false, 'size': 'sm'});

JS;
$this->registerJs($js);

?>

<div class="feedback-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'score')->textInput(['type' => 'text', 'id' => 'star-rating']) ?>

        <?= $form->field($model, 'content')->widget(\app\widgets\CustomTinyMce::class, [
            'options' => ['row' => 10, 'id' => 'tiny-editor'],
        ]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
