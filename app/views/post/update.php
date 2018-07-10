<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $allTags \app\models\Tag[] */
/* @var $allCats \app\models\Category[] */
/* @var $hasTags \app\models\Tag[] */
/* @var $hasCats \app\models\Category[] */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Post',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="post-update">

    <?= $this->render('_form', [
        'model' => $model,
        'allTags' => $allTags,
        'allCats' => $allCats,
        'hasTags' => $hasTags,
        'hasCats' => $hasCats,
    ]) ?>

</div>
