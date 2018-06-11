<?php

use app\models\User;
use app\widgets\BatchDeleteButton;
use app\widgets\GridSettingModal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $roles \app\models\Role[] */

//$this->title = Yii::t('app', 'Users');
//$this->params['breadcrumbs'][] = $this->title;

$roleNames = [];
array_walk($roles, function ($role, $idx) use(&$roleNames) {
    $roleNames[$role->name] = $role->name;
});

// select row
$allModels = $dataProvider->getModels();
$modelArray = [];
foreach ($allModels as $m) {
    $modelArray[$m->id]  = ['id' => $m->id, 'username' => $m->username];
}
$modelJson = json_encode($modelArray);
$jsEnd = <<<JS
function getSelectedRows() {
  var keys = $('#grid').yiiGridView('getSelectedRows');
  $('input[type="checkbox"]').prop('checked', false);     // uncheck all checkbox
  
  var allModels = $modelJson
  var selected = [];
  for(var idx in keys) {
      selected.push(allModels[keys[idx]])
  }
  return selected;
}
JS;
$this->registerJs($jsEnd, \yii\web\View::POS_END);

?>
<div class="user-index box box-default picker">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
    </div>
    <div class="box-body table-responsive no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id' => 'grid',
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],
                [
                    'class' => '\yii\grid\CheckboxColumn',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                ],
                'username',
                ['attribute' => 'email', 'format' => 'email'],
                ['attribute' => 'role', 'value' => 'role.name', 'filter' => $roleNames],
                ['attribute' => 'status',
                    'filter' => [User::STATUS_ENABLED => 'Enabled', User::STATUS_DISABLED => 'Disabled'],
                    'value' => function($model, $key, $index, $column) {
                        return $model->status == User::STATUS_ENABLED ? 'Enabled' : 'Disabled';
                    }
                ],
            ],
        ]); ?>
    </div>

    <?php Pjax::end(); ?>
</div>
