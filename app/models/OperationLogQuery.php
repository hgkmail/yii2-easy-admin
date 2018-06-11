<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[OperationLog]].
 *
 * @see OperationLog
 */
class OperationLogQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return OperationLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OperationLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
