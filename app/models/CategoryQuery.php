<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Category]].
 *
 * @see Category
 */
class CategoryQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]='.Category::STATUS_ENABLED);
    }

    /**
     * {@inheritdoc}
     * @return Category[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Category|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param array $cats
     * @return Category[]
     */
    public static function getChildren(array $cats)
    {
        if(empty($cats)) {
            return [];
        }
        $ids = [];
        foreach ($cats as $cat) {
            if($cat->id>0) {
                $ids[] = $cat->id;
            }
        }
        if(empty($ids)) {
            return [];
        }
        return Category::find()->where(['in', 'parent_id', $ids])->all();
    }

    /**
     * @param array $cats
     * @return Category[]
     */
    public static function getGrandchildren(array $cats)
    {
        $result = [];
        $current = $cats;
        while(!empty($current)) {
            $children = static::getChildren($current);
            $result = array_merge($result, $children);
            $current = $children;
        }
        return $result;
    }
}
