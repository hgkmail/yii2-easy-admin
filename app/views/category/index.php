<?php

use app\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

$js = <<<JS
$('body').on('keyup', '#top-filter', function(event) {
  if (event.keyCode=='13') {
      window.location.href = "/category/index?top-filter="+$(this).val();
  }
});

$('span.glyphicon-trash').closest('a').data('confirm', '这会一并删除此项的所有子节点，您确定要删除吗?');
JS;
$this->registerJs($js);

?>
<div class="category-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <div class="form-inline">
            <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
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
                ['class' => 'yii\grid\ActionColumn'],
                ['attribute' => 'name', 'format' => 'raw'],
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        return $model->status == Category::STATUS_ENABLED?'Enabled':'Disabled';
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
