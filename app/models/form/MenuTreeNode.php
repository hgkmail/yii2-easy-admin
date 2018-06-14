<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-12
 * Time: 上午3:58
 */

namespace app\models\form;


use app\models\Menu;

/**
 * Class MenuTreeNode
 * Model of FancyTree Widget and MainMenu Widget
 * TODO: separate to 2 classes
 * @package app\models\form
 */
class MenuTreeNode implements \ArrayAccess
{
    /******** db attribute ***********/

    public $key;                 // id

    public $parent_id;

    public $title;               // icon + label

    public $_icon;               // icon

    public $_label;              // label

    public $url;

    public $_url;                // ['<route>', '#' => '<tag>']

    public $order;

    /******** widget attribute ***********/

    public $children;

    public $folder;

    public $expanded;

    public $isSelect;

    public $_active;              // focus

    public $_options;             // html attribute

    public $_template;            // menu widget

    /**
     * MenuTreeNode constructor.
     * @param $menu Menu
     */
    public function __construct($menu)
    {
        $this->key = (string)$menu->id;
        $this->parent_id = $menu->parent_id;
        $this->_icon = $menu->icon;
        $this->_label = $menu->label;
        $this->title = "<i class='fa fa-$menu->icon'></i>".$menu->label;
        $this->url = $menu->url;
        $this->_url = [$menu->url];   // can has ['#' => '<tag>']
        $this->order = $menu->order;
        $this->children = [];
        $this->folder = false;
        $this->expanded = false;
        $this->isSelect = false;
        $this->_active = false;
        $this->_options = null;
        $this->_template = null;
    }

    /**
     * @param Menu[] $menus
     * @return MenuTreeNode[]
     */
    public static function toNodeList(array $menus)
    {
        $result = [];
        if(empty($menus)) {
            return $result;
        }
        foreach ($menus as $menu) {
            $result[] = new MenuTreeNode($menu);
        }
        return $result;
    }

    /*************** ArrayAccess method ***************/

    private static $_fieldMap = [
        'id' => 'key',
        'items' => 'children',
        'label' => '_label',
        'icon' => '_icon',
        'url' => '_url',
        'active' => '_active',
        'options' => '_options',
        'template' => '_template',
    ];

    /**
     * exist => not empty
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        if(array_key_exists($offset, self::$_fieldMap)) {
            $newOffset = self::$_fieldMap[$offset];
            return !empty($this->$newOffset);
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        if(array_key_exists($offset, self::$_fieldMap)) {
            $newOffset = self::$_fieldMap[$offset];
            return $this->$newOffset;
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        if(array_key_exists($offset, self::$_fieldMap)) {
            $newOffset = self::$_fieldMap[$offset];
            $this->$newOffset = $value;
        }
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        if(array_key_exists($offset, self::$_fieldMap)) {
            $newOffset = self::$_fieldMap[$offset];
            $this->$newOffset = null;
        }
    }
}