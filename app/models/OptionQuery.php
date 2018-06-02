<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Option]].
 *
 * @see Option
 */
class OptionQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Option[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Option|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
