<?php

use app\models\Post;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form ActiveForm */
/* @var $allTags \app\models\Tag[] */
/* @var $allCats \app\models\Category[] */
/* @var $hasTags \app\models\Tag[] */
/* @var $hasCats \app\models\Category[] */

?>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(['id' => 'post-form']); ?>
            <div class="nav-tabs-custom">
                <!-- tabs -->
                <ul class="nav nav-tabs pull-left">
                    <li class="active"><a href="#user-basic" data-toggle="tab">Content</a></li>
                    <li><a href="#user-profile" data-toggle="tab">Info</a></li>
                </ul>
                <!-- tab-panes -->
                <div class="tab-content no-padding">
                    <div class="chart tab-pane active" id="user-basic" style="position: relative;">
                        <?= $this->render('_fieldset_content', [
                            'form' => $form,
                            'model' => $model,
                        ]) ?>
                    </div>
                    <div class="chart tab-pane" id="user-profile" style="position: relative;">
                        <?= $this->render('_fieldset_info', [
                            'form' => $form,
                            'model' => $model,
                            'allTags' => $allTags,
                            'allCats' => $allCats,
                            'hasTags' => $hasTags,
                            'hasCats' => $hasCats,
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
        <?= \app\widgets\CropModal::widget() ?>
    </div>
</div>
