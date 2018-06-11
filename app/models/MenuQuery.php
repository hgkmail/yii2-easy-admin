<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Menu]].
 *
 * @see Menu
 */
class MenuQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Menu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Menu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
