<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%feedback}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property int $score
 * @property int $created_at
 */
class Feedback extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%feedback}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'score', 'created_at'], 'integer'],
            ['score', 'integer', 'max' => 5, 'min' => 0],
            [['title', 'content'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,

            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
                'defaultValue' => 0,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'score' => Yii::t('app', 'Score'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return FeedbackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeedbackQuery(get_called_class());
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
