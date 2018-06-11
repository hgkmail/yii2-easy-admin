<?php

use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\form\RegisterForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $roles app\models\Role[] */
/* @var $userprofile \app\models\UserProfile */

$profileHasError = isset($userprofile) && $userprofile->hasErrors();
$basicActive = $profileHasError ? '' : 'active';
$profileActive = $profileHasError ? 'active' : '';

?>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(['id' => 'user-form']); ?>

        <div class="nav-tabs-custom">
            <!-- tabs -->
            <ul class="nav nav-tabs pull-left">
                <li class="<?= $basicActive ?>"><a href="#user-basic" data-toggle="tab">Basic</a></li>
                <?php if(!empty($model->getUser())) { ?>
                <li class="<?= $profileActive ?>"><a href="#user-profile" data-toggle="tab">Profile</a></li>
                <?php } ?>
            </ul>
            <!-- tab-panes -->
            <div class="tab-content no-padding">
                <div class="chart tab-pane <?= $basicActive ?>" id="user-basic" style="position: relative;">
                    <?= $this->render("_fieldset", [
                            'form' => $form,
                            'model' => $model,
                            'roles' => $roles,
                    ]) ?>
                </div>
                <?php if(!empty($model->getUser())) { ?>
                <div class="chart tab-pane <?= $profileActive ?>" id="user-profile" style="position: relative;">
                    <?= $this->render("@app/views/userprofile/_fieldset", [
                            'form' => $form,
                            'model' => $userprofile,
                    ]) ?>
                </div>
                <?php } ?>
            </div>
            <!-- end of tab-panes -->
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
