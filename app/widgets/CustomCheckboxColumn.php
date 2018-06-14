<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-12
 * Time: 下午8:07
 */

namespace app\widgets;


use yii\grid\CheckboxColumn;

class CustomCheckboxColumn extends CheckboxColumn
{
    public function init()
    {
        parent::init();

        $this->headerOptions = array_merge($this->headerOptions, ['class' => 'text-center']);
        $this->contentOptions = array_merge($this->contentOptions, ['class' => 'text-center']);
    }
}