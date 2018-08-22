<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Like]].
 *
 * @see Like
 */
class LikeQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Like[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Like|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
