<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Media]].
 *
 * @see Media
 */
class MediaQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=:st', [':st' => Media::STATUS_ENABLED]);
    }

    /**
     * {@inheritdoc}
     * @return Media[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Media|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
