<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-5
 * Time: 上午2:35
 */

namespace app\commands\misc;

class TreeNode
{
    public $id;
    public $parentId;
    public $name;

    public function __construct($id, $parentId, $name)
    {
        $this->id = $id;
        $this->parentId = $parentId;
        $this->name = $name;
    }
}