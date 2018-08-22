<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Like */
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

?>

<div class="like-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'post_id')->dropDownList($postDict, ['prompt' => 'Please select a post']) ?>

        <?= $form->field($model, 'user_id')->dropDownList($userDict, ['prompt' => 'Please select a user']) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
