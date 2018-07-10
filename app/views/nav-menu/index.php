<?php

use app\models\NavMenu;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\NavMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nav Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-menu-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create Nav Menu'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
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
                'name',
                'location',
                [
                    'attribute' => 'status',
                    'filter' => [NavMenu::STATUS_ENABLED => 'Enabled', NavMenu::STATUS_DISABLED => 'Disabled'],
                    'value' => function ($model) {
                        return $model->status == NavMenu::STATUS_ENABLED ? 'Enabled' : 'Disabled';
                    },
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
