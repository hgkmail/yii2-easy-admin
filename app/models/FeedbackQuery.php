<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Feedback]].
 *
 * @see Feedback
 */
class FeedbackQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return Feedback[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Feedback|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
