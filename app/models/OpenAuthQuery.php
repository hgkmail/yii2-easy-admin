<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[OpenAuth]].
 *
 * @see OpenAuth
 */
class OpenAuthQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpenAuth[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpenAuth|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
