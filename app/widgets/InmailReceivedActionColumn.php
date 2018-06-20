<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-20
 * Time: 下午6:36
 */

namespace app\widgets;


use yii\bootstrap\Html;
use yii\grid\ActionColumn;

class InmailReceivedActionColumn extends ActionColumn
{
    public $template = '{view} {delete} {mark-read}';

    protected function initDefaultButtons()
    {
        parent::initDefaultButtons();
        $this->buttons['mark-read'] = function ($url, $model, $key) {
            $options = array_merge([
                'title' => 'Mark Read',
                'aria-label' => 'Mark Read',
                'data-pjax' => '0',
            ], $this->buttonOptions);
            $icon = Html::tag('i', '', ['class' => "fa fa-check"]);
            return Html::a($icon, $url, $options);
        };
        $this->visibleButtons['mark-read'] = function ($model, $key, $index) {
            return $model->read_at == 0;
        };
    }
}