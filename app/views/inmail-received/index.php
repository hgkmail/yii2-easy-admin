<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\InmailReceivedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Inbox');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inmail-received-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Send Inmail'), "/inmail/create", ['class' => 'btn btn-success btn-flat']) ?>
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
                    'class' => '\app\widgets\InmailReceivedActionColumn',
                ],
                [
                    'attribute' => 'sender',
                    'contentOptions' => function($model) {
                        if($model->read_at==0) {
                            return ['class' => 'unread'];
                        } else {
                            return [];
                        }
                    },
                ],
                [
                    'attribute' => 'subject',
                    'contentOptions' => function($model) {
                        if($model->read_at==0) {
                            return ['class' => 'unread'];
                        } else {
                            return [];
                        }
                    },
                ],
                [
                    'attribute' => 'created_at',
                    'format' => 'date',
                    'filter' => false,
                    'contentOptions' => function($model) {
                        if($model->read_at==0) {
                            return ['class' => 'unread'];
                        } else {
                            return [];
                        }
                    },
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
