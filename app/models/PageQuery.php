<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Page]].
 *
 * @see Page
 */
class PageQuery extends ActiveQuery
{
    public function defaultOrder()
    {
        return $this->orderBy(['order' => SORT_ASC, 'id' => SORT_ASC]);
    }

    /**
     * {@inheritdoc}
     * @return Page[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Page|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
