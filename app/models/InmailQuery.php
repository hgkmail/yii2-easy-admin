<?php

namespace app\models;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Inmail]].
 *
 * @see Inmail
 */
class InmailQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Inmail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Inmail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
