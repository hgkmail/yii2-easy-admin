<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menus');
$this->params['breadcrumbs'][] = $this->title;

$js = <<<JS
$('body').on('keyup', '#top-filter', function(event) {
  if (event.keyCode=='13') {
      window.location.href = "/menu/index?top-filter="+$(this).val();
  }
});

$('span.glyphicon-trash').closest('a').data('confirm', '这会一并删除此项的所有子节点，您确定要删除吗?');
JS;
$this->registerJs($js);

?>
<div class="menu-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <div class="form-inline">
            <?= Html::a(Yii::t('app', 'Create Menu'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
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
//            'layout' => "{items}\n{summary}\n{pager}",
            'layout' => "{items}\n{pager}",
            'columns' => [
                ['class' => '\app\widgets\CustomCheckboxColumn'],
                ['class' => '\app\widgets\MenuActionColumn'],
                ['attribute' => 'label', 'format' => 'raw'],
                [
                        'attribute' => 'icon',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $icon = $model->icon;
                            return "<i class='fa fa-$icon' style='font-size: 18px'></i>($icon)";
                        }
                ],
                'url:url',
                'order',
                // 'parent_id',
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
