<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-7-1
 * Time: 下午2:16
 */

namespace app\base;


class CommonWalker extends Walker
{
    /**
     * drop down items
     * @var array
     */
    public $items = [];

    public $repeat = 6;

    public $mark = " ";

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
        $indent = str_repeat($this->mark, $depth*$this->repeat);
        $label_field = $this->label_field;
        $this->items[$object->id] = $indent.$object->$label_field;
    }

    public function end_el( &$output, $object, $depth = 0, $args = array() )
    {
    }
}