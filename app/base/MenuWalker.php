<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-5
 * Time: 上午4:57
 */

namespace app\base;


class MenuWalker extends Walker
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


    public function start_lvl( &$output, $depth = 0, $args = array() )
    {
    }

    public function end_lvl( &$output, $depth = 0, $args = array() )
    {
    }

    public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 )
    {
        $indent = str_repeat($this->mark, $depth*$this->repeat);
        $this->items[$object->id] = $indent.$object->label;
    }

    public function end_el( &$output, $object, $depth = 0, $args = array() )
    {
    }
}