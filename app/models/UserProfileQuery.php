<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserProfile]].
 *
 * @see UserProfile
 */
class UserProfileQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return UserProfile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserProfile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
