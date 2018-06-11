<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-10
 * Time: 上午4:02
 */

use app\models\UserProfile;
use app\widgets\FileUploadWidget;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model UserProfile */

$birthdayHtml = <<<HTML
<div class="input-group">
    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    {input}
</div>
HTML;

$genderItems = [
        UserProfile::GENDER_MALE => 'Male',
        UserProfile::GENDER_FEMALE => 'Female',
];
$model->gender = isset($model->gender) ? $model->gender : UserProfile::GENDER_MALE;

\app\assets\DatePickerAsset::register($this);
$js = <<<JS
$('#birthday').datepicker({autoclose: true, format: "yyyy-mm-dd"});
JS;
$this->registerJs($js);

?>

<!-- profile box -->
<div class="userprofile-form box box-solid box-no-shadow">
    <div class="box-body table-responsive">
        <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'gender', ['inline' => true])->radioList($genderItems,
            ['itemOptions' => ['labelOptions' => ['class' => 'text-black']]]) ?>

        <?= $form->field($model, 'avatar', ['options' => ['style' => 'max-width:400px;']])
            ->widget(FileUploadWidget::class, [
                'category' => 'avatar',
                'useCropModal' => 1,
                'idAttribute' => 'user_id',
                'allowExt' => ['jpeg', 'jpg', 'png', 'gif', 'bmp'],
            ]) ?>

        <?= $form->field($model, 'phone_number')->textInput() ?>

        <?= $form->field($model, 'birthday', ['inputTemplate' => $birthdayHtml])->textInput(['id' => 'birthday']) ?>

        <?= $form->field($model, 'description')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
</div>
<?= \app\widgets\CropModal::widget([]) ?>