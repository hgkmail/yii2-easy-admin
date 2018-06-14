<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-5-31
 * Time: 下午6:34
 */

namespace app\services;


use app\base\NotLoginException;
use app\models\form\MenuTreeNode;
use app\models\Menu;
use app\models\Role;
use Yii;
use yii\base\Component;
use yii\base\InvalidArgumentException;

class MainMenuService extends Component
{
    const SESSION_MAIN_MENU = 'main-menu';

    private $staticItems = [];

    public function init()
    {
        parent::init();

        $this->staticItems = [
            ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
            ['label' => 'Login', 'icon' => 'sign-in', 'url' => ['/site/login']],
        ];
    }

    /**
     * @return array
     */
    public function getMenuItems()
    {

        $menuList = $this->getUserMenuCache();
        if (Yii::$app->user->getIsGuest() || empty($menuList)) {
            return $this->staticItems;
        } else {
            return $menuList;
        }
    }

    /**
     * Get children of these menus, not include grandchildren
     * @param Menu[] $menus
     * @return Menu[]
     */
    public function getChildren(array $menus)
    {
        if(empty($menus)) {
            return [];
        }
        $ids = [];
        foreach ($menus as $menu) {
            if($menu->id>0) {
                $ids[] = $menu->id;
            }
        }
        if(empty($ids)) {
            return [];
        }
        return Menu::find()->where(['in', 'parent_id', $ids])->all();
    }

    /**
     * Get children of these menus, include grandchildren
     * @param Menu[] $menus
     * @return Menu[]
     */
    public function getGrandchildren(array $menus)
    {
        $result = [];
        $current = $menus;
        while(!empty($current)) {
            $children = $this->getChildren($current);
            $result = array_merge($result, $children);
            $current = $children;
        }
        return $result;
    }

    /**
     * @param $nodeList MenuTreeNode[]
     * @return MenuTreeNode[]
     */
    public function convertTree($nodeList)
    {
        $top = [];
        $map = [];
        foreach ($nodeList as $node) {
            $map[$node->key] = $node;
        }
        foreach ($nodeList as $node) {
            if($node->parent_id==0) {
                $top[] = $node;
            } else if(array_key_exists($node->parent_id, $map)) {
                $parent = $map[$node->parent_id];
                $parent->children[] = $node;
                $parent->folder = true;
            }
            // else: ignore orphan node
        }
        return $top;
    }

    public function getTree()
    {
        return $this->convertTree(MenuTreeNode::toNodeList(Menu::find()->defaultOrder()->all()));
    }

    /**
     * Move Menu among same parent
     * @param $menu Menu
     * @param $step int
     */
    public function move($menu, $step) {
        $list = Menu::find()
            ->where(['parent_id' => $menu->parent_id])
            ->orderBy(['order' => SORT_ASC, 'id' => SORT_ASC])->all();
        $len = count($list);
        $pos = 0;
        for ($i = 0; $i < $len; $i++) {   // init order
            $el = $list[$i];
            $el->order = $i+1;
            if($el->id==$menu->id) {
                $pos = $i;
            }
        }
        $newPos = $pos + $step;
        if(array_key_exists($newPos, $list)) {   // exchange order
            $temp = $list[$newPos]->order;
            $list[$newPos]->order = $list[$pos]->order;
            $list[$pos]->order = $temp;
        }
        foreach ($list as $one) {
            $one->save();
        }
    }

    /**
     * @param Menu[] $all
     * @param Menu[] $part
     * @return Menu[]
     */
    public function includeParent(array $all, array $part)
    {
        $result = [];
        $map = [];
        $selectedMap = [];
        foreach ($all as $n) {
            $map[$n->id] = $n;
        }
        foreach ($part as $p) {
            $selectedMap[$p->id] = 1;
        }
        foreach ($part as $m) {
            $parentId = $m->parent_id;
            while($parentId!=0 && array_key_exists($parentId, $map) && !array_key_exists($parentId, $selectedMap)) {
                $parent = $map[$parentId];
                $result[] = $parent;
                unset($map[$parentId]);
                $parentId = $parent->parent_id;
            }
        }
        $result = array_merge($result, $part);
        usort($result, array($this, 'compareMenu'));
        return $result;
    }

    public function putUserMenuCache()
    {
        if (Yii::$app->user->getIsGuest()) {
            throw new NotLoginException();
        }
        /* @var $role Role */
        $role = Yii::$app->user->identity->role;
        if (empty($role)) {
            throw new InvalidArgumentException("Current user doesn't have a role");
        }
        $menuList = Menu::find()->defaultOrder()->all();
        $selectedMenuList = $role->menus;
        $menuList = $this->includeParent($menuList, $selectedMenuList);
        $nodeList = $this->convertTree(MenuTreeNode::toNodeList($menuList));
        // add menu header
        $header = new MenuTreeNode(new Menu());
        $header->_label = 'Menu Yii2 Easy Admin';
        $header->_template = '<span>{label}</span>';
        $header->_options = ['class' => 'header'];
        array_unshift($nodeList, $header);

        Yii::$app->session->set(self::SESSION_MAIN_MENU, $nodeList);
    }

    public function clearUserMenuCache()
    {
        Yii::$app->session->remove(self::SESSION_MAIN_MENU);
    }

    public function getUserMenuCache()
    {
        return Yii::$app->session->get(self::SESSION_MAIN_MENU, []);
    }

    /**
     * @param $a Menu
     * @param $b Menu
     * @return int
     */
    private function compareMenu($a, $b)
    {
        if($a->order!=$b->order)
            return $a->order - $b->order;
        else
            return $a->id - $b->id;
    }
}