<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[NavMenu]].
 *
 * @see NavMenu
 */
class NavMenuQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=:st', [':st' => NavMenu::STATUS_ENABLED]);
    }

    /**
     * {@inheritdoc}
     * @return NavMenu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return NavMenu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
