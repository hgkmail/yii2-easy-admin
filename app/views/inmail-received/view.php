<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InmailReceived */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inbox'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inmail-received-view box box-primary">
    <div class="box-header">
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'sender',
                [
                    'attribute' => 'receivers',
                    'value' => function($model) {
                        $rs = $model->receivers;
                        $array = explode(':', $rs);
                        return implode(', ', $array);
                    }
                ],
                'subject',
                'content:raw',
                'created_at:datetime',
            ],
        ]) ?>
    </div>
</div>
