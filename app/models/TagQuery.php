<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Tag]].
 *
 * @see Tag
 */
class TagQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => Tag::STATUS_ENABLED]);
    }

    /**
     * {@inheritdoc}
     * @return Tag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Tag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
