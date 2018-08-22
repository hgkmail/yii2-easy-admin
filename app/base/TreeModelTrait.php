<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-8-22
 * Time: 下午9:25
 */

namespace app\base;


trait TreeModelTrait
{
    public static $idField = 'id';

    public static $parentField = 'parent_id';

    public static $orderField = 'order';

    public static $childrenField = "children";    // for display only

    /**
     * Get children of these models, not include grandchildren
     * @param TreeModelTrait[] $models
     * @return TreeModelTrait[]
     */
    public static function getChildren(array $models)
    {
        $idField = self::$idField;
        $parentField = self::$parentField;
//        $orderField = self::$orderField;

        if(empty($models)) {
            return [];
        }
        $ids = [];
        foreach ($models as $model) {
            if($model->$idField > 0) {
                $ids[] = $model->$idField;
            }
        }
        if(empty($ids)) {
            return [];
        }
        return self::find()->where(['in', $parentField, $ids])->all();
    }

    /**
     * Get children of these models, include grandchildren
     * @param TreeModelTrait[] $models
     * @return TreeModelTrait[]
     */
    public static function getGrandchildren(array $models)
    {
        $result = [];
        $current = $models;
        while(!empty($current)) {
            $children = self::getChildren($current);
            $result = array_merge($result, $children);
            $current = $children;
        }
        return $result;
    }

    /**
     * @param $models TreeModelTrait[]
     * @return TreeModelTrait[]
     */
    public static function convertTree($models)
    {
        $idField = self::$idField;
        $parentField = self::$parentField;
        $childrenField = self::$childrenField;

        $top = [];
        $map = [];
        foreach ($models as $model) {
            $map[$model->$idField] = $model;
        }
        foreach ($models as $model) {
            if($model->$parentField == 0) {
                $top[] = $model;
            } else if(array_key_exists($model->$parentField, $map)) {
                $parent = $map[$model->$parentField];
                $parent->$childrenField[] = $model;
            }
            // else: ignore orphan node
        }
        return $top;
    }

    /**
     * Move Model among same parent
     * @param $model TreeModelTrait
     * @param $step int
     */
    public static function move($model, $step) {
        $idField = self::$idField;
        $parentField = self::$parentField;
        $orderField = self::$orderField;

        $list = self::find()
            ->where([$parentField => $model->$parentField])
            ->orderBy([$orderField => SORT_ASC, $idField => SORT_ASC])->all();
        $len = count($list);
        $pos = 0;
        for ($i = 0; $i < $len; $i++) {   // init order
            $el = $list[$i];
            $el->$orderField = $i+1;
            if($el->$idField==$model->$idField) {
                $pos = $i;
            }
        }
        $newPos = $pos + $step;
        if(array_key_exists($newPos, $list)) {   // exchange order
            $temp = $list[$newPos]->$orderField;
            $list[$newPos]->$orderField = $list[$pos]->$orderField;
            $list[$pos]->$orderField = $temp;
        }
        foreach ($list as $one) {
            $one->save();
        }
    }

    /**
     * @param TreeModelTrait[] $all
     * @param TreeModelTrait[] $part
     * @return TreeModelTrait[]
     */
    public static function includeParent(array $all, array $part)
    {
        $idField = self::$idField;
        $parentField = self::$parentField;
//        $orderField = self::$orderField;

        $result = [];
        $map = [];
        $selectedMap = [];
        foreach ($all as $n) {
            $map[$n->$idField] = $n;
        }
        foreach ($part as $p) {
            $selectedMap[$p->$idField] = 1;
        }
        foreach ($part as $m) {
            $parentId = $m->$parentField;
            while($parentId!=0 && array_key_exists($parentId, $map) && !array_key_exists($parentId, $selectedMap)) {
                $parent = $map[$parentId];
                $result[] = $parent;
                unset($map[$parentId]);
                $parentId = $parent->$parentField;
            }
        }
        $result = array_merge($result, $part);
        usort($result, array('self', 'compareMenu'));
        return $result;
    }

    /**
     * @param $a TreeModelTrait
     * @param $b TreeModelTrait
     * @return int
     */
    private static function compareMenu($a, $b)
    {
        $idField = self::$idField;
        $orderField = self::$orderField;

        if($a->$orderField!=$b->$orderField)
            return $a->$orderField - $b->$orderField;
        else
            return $a->$idField - $b->$idField;
    }
}