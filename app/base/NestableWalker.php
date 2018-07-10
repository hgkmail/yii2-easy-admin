<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-7-9
 * Time: 上午2:06
 */

namespace app\base;


use yii\bootstrap\Html;

class NestableWalker
{
    public $output = '';

    /**
     * @param array $array
     */
    public function walk($array)
    {
        if(empty($array)) {
            return;
        }
        foreach ($array as $item) {
            $this->output.="<li class='dd-item dd3-item' data-id='{$item['id']}'>";

            // handle and button
            $this->output.="<div class='dd-handle dd3-handle'></div><div class='dd3-content'>
                            <span class='dd-item-name'>Item</span>";
            $this->output.="<a class='pull-right dd-btn dd-config'><span class='fa fa-gear'></span></a>";
            $this->output.="<a class='pull-right dd-btn dd-remove'><span class='fa fa-remove'></span></a>";
            $this->output.="<input type='hidden' name='nav_menu_items[]' class='dd-data'>";
            $this->output.= "</div>";

            // children
            if(!empty($item['children'])) {
                $this->output.="<ol class='dd-list'>";
                $this->walk($item['children']);
                $this->output.="</ol>";
            }

            $this->output.="</li>";
        }
    }
}