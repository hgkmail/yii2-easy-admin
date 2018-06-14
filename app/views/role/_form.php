<?php

use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $form yii\widgets\ActiveForm */
/* @var $menuList \app\models\Menu[] */
/* @var $selectedMenuList \app\models\Menu[] */

$hasMenuList = isset($menuList);

$js = <<<JS
JS;
$this->registerJs($js);

?>

<div class="role-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?php if ($hasMenuList) { ?>
            <?= Html::label('Enable Menus', 'menu-tree') ?>
            <?= \app\widgets\MenuTreeWidget::widget([
                'menuList' => $menuList,
                'selectedMenuList' => $selectedMenuList,
            ]) ?>
        <?php } ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
