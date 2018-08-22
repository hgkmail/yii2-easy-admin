<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Comment]].
 *
 * @see Comment
 */
class CommentQuery extends ActiveQuery
{
    public function reviewed()
    {
        return $this->andWhere('[[status]]=:st', [':st'=>Comment::STATUS_REVIEWED]);
    }

    /**
     * {@inheritdoc}
     * @return Comment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Comment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
