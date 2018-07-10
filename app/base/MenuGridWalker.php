<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-5
 * Time: 上午4:57
 */

namespace app\base;


class MenuGridWalker extends Walker
{
    /**
     * drop down items
     * @var array
     */
    public $items = [];

    public $repeat = 1;

    public $mark = "—&nbsp;";

    public $db_fields = [
        'id'     => 'id',
        'parent' => 'parent_id',
    ];

    public $label_field = 'label';

    public function start_lvl( &$output, $depth = 0, $args = array() )
    {
    }

    public function end_lvl( &$output, $depth = 0, $args = array() )
    {
    }

    public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 )
    {
        if($depth==0 && $object->parent_id!=0) {  // ignore orphans
            return;
        }
        $indent = str_repeat($this->mark, $depth*$this->repeat);
        $label_field = $this->label_field;
        $this->items[$object->id] = $object;
        $this->items[$object->id]->$label_field = $indent.$object->$label_field;
    }

    public function end_el( &$output, $object, $depth = 0, $args = array() )
    {
    }
}