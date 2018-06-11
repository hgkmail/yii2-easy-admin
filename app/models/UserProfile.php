<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property int $user_id
 * @property string $nickname
 * @property int $gender
 * @property string $avatar
 * @property string $phone_number
 * @property string $birthday
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class UserProfile extends ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'gender', 'created_at', 'updated_at'], 'integer'],
            [['birthday'], 'date', 'format' => 'yyyy-MM-dd'],
            [['nickname', 'phone_number', 'description'], 'string', 'max' => 255],
            [['avatar'], 'string', 'max' => 1000],
            ['phone_number', 'match', 'pattern' => '/^[0-9\-]+$/i'],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'nickname' => Yii::t('app', 'Nickname'),
            'gender' => Yii::t('app', 'Gender'),
            'avatar' => Yii::t('app', 'Avatar'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'birthday' => Yii::t('app', 'Birthday'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->inverseOf('userProfile');
    }

    /**
     * {@inheritdoc}
     * @return UserProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserProfileQuery(get_called_class());
    }
}
