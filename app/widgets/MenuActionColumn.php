<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-12
 * Time: 下午6:46
 */

namespace app\widgets;


use yii\grid\ActionColumn;
use yii\helpers\Html;

class MenuActionColumn extends ActionColumn
{
    public $template = '{view} {update} {delete} {move-up} {move-down}';

    protected function initDefaultButtons()
    {
        parent::initDefaultButtons();
        $this->buttons['move-up'] = function ($url, $model, $key) {
            $options = array_merge([
                'title' => 'Move Up',
                'aria-label' => 'Move Up',
                'data-pjax' => '0',
            ], $this->buttonOptions);
            $icon = Html::tag('i', '', ['class' => "fa fa-arrow-up"]);
            return Html::a($icon, $url, $options);
        };
        $this->buttons['move-down'] = function ($url, $model, $key) {
            $options = array_merge([
                'title' => 'Move Down',
                'aria-label' => 'Move Down',
                'data-pjax' => '0',
            ], $this->buttonOptions);
            $icon = Html::tag('i', '', ['class' => "fa fa-arrow-down"]);
            return Html::a($icon, $url, $options);
        };
    }
}