<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[NavMenuItem]].
 *
 * @see NavMenuItem
 */
class NavMenuItemQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=:st', [':st' => NavMenuItem::STATUS_ENABLED]);
    }

    /**
     * {@inheritdoc}
     * @return NavMenuItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return NavMenuItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
