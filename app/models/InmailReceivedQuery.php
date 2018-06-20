<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[InmailReceived]].
 *
 * @see InmailReceived
 */
class InmailReceivedQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InmailReceived[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InmailReceived|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
