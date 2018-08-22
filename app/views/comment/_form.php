<?php

use app\models\Comment;
use app\widgets\CustomTinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $form yii\widgets\ActiveForm */
/* @var $posts \app\models\Post[] */
/* @var $users \app\models\User[] */

$postDict = [];
foreach ($posts as $post) {
    $postDict[$post->id]=$post->title;
}

$userDict = [];
foreach ($users as $user) {
    $userDict[$user->id]=$user->username;
}

$statusDict = [];
$statusDict[Comment::STATUS_PENDING]="Pending";
$statusDict[Comment::STATUS_REVIEWED]="Reviewed";
$statusDict[Comment::STATUS_SPAM]="Spam";

?>

<div class="comment-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'post_id')->dropDownList($postDict, ['prompt' => 'Please select a post']) ?>

        <?= $form->field($model, 'user_id')->dropDownList($userDict, ['prompt' => 'Please select a user']) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->widget(CustomTinyMce::class, [
            'options' => ['row' => 10, 'id' => 'tiny-editor'],
        ]) ?>

        <?= $form->field($model, 'status')->dropDownList($statusDict) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
