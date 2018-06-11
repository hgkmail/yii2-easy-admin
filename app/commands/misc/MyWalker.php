<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-5
 * Time: 上午2:36
 */

namespace app\commands\misc;


use app\base\Walker;

class MyWalker extends Walker
{
    public $db_fields = [
        'id'     => 'id',
        'parent' => 'parentId',
    ];

    public function start_lvl( &$output, $depth = 0, $args = array() )
    {
        $indent = str_repeat( "  ", $depth );
        $output .= "\n$indent<ul>\n";
    }

    public function end_lvl( &$output, $depth = 0, $args = array() )
    {
        $indent = str_repeat( "  ", $depth );
        $output .= "$indent</ul>\n";
    }

    public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 )
    {
        $indent = str_repeat( "  ", $depth );
        $output .= "$indent<li>".$object->name;
    }

    public function end_el( &$output, $object, $depth = 0, $args = array() )
    {
        $indent = str_repeat( "  ", $depth );
        $output .= "$indent</li>\n";
    }
}