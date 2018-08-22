<?php

use app\models\Page;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;

$statusDict=[];
$statusDict[Page::STATUS_DRAFT]='Draft';
$statusDict[Page::STATUS_PUBLISH]='Publish';
$statusDict[Page::STATUS_PENDING_REVIEW]='Pending Review';

$visibilityDict=[];
$visibilityDict[Page::VISIBILITY_PUBLIC]='Public';
$visibilityDict[Page::VISIBILITY_PRIVATE]='Private';

$js = <<<JS
$('body').on('keyup', '#top-filter', function(event) {
  if (event.keyCode=='13') {
      window.location.href = "/page/index?top-filter="+$(this).val();
  }
});

$('span.glyphicon-trash').closest('a').data('confirm', '这会一并删除此项的所有子节点，您确定要删除吗?');
JS;
$this->registerJs($js);

?>
<div class="page-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <div class="form-inline">
            <?= Html::a(Yii::t('app', 'Create Page'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
            <?= Html::a(Yii::t('app', 'Display Level'), ['index'], ['class' => 'btn btn-primary btn-flat']) ?>
            <div class="form-group">
                <?= Html::label("Top Filter:", "top-filter") ?>
                <?= Html::input("text", "top-filter", '', ['id' => 'top-filter', 'class' => 'form-control']) ?>
            </div>
        </div>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => '\app\widgets\CustomCheckboxColumn'],
                ['class' => '\app\widgets\MenuActionColumn'],
                [
                    'attribute' => 'title',
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'author',
                    'value' => 'author.username',
                ],
                [
                    'attribute' => 'status',
                    'filter' => $statusDict,
                    'value' => function($model) {
                        $statusDict=[];
                        $statusDict[Page::STATUS_DRAFT]='Draft';
                        $statusDict[Page::STATUS_PUBLISH]='Publish';
                        $statusDict[Page::STATUS_PENDING_REVIEW]='Pending Review';
                        return $statusDict[$model->status];
                    }
                ],
                [
                    'attribute' => 'visibility',
                    'filter' => $visibilityDict,
                    'value' => function($model) {
                        $visibilityDict=[];
                        $visibilityDict[Page::VISIBILITY_PUBLIC]='Public';
                        $visibilityDict[Page::VISIBILITY_PRIVATE]='Private';
                        return $visibilityDict[$model->visibility];
                    }
                ],
                'order',
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
