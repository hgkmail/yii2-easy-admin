<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $allTags \app\models\Tag[] */
/* @var $allCats \app\models\Category[] */

$this->title = Yii::t('app', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <?= $this->render('_form', [
        'model' => $model,
        'allTags' => $allTags,
        'allCats' => $allCats,
    ]) ?>

</div>
