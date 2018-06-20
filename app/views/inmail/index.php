<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\InmailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sent');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inmail-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Send Inmail'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => '\app\widgets\CustomCheckboxColumn'],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}',
                ],
//                'sender',
                [
                    'attribute' => 'receivers',
                    'value' => function($model) {
                        $rs = $model->receivers;
                        $array = explode(':', $rs);
                        return implode(', ', $array);
                    }
                ],
                'subject',
                [
                    'attribute' => 'created_at',
                    'format' => 'date',
                    'filter' => false,
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
