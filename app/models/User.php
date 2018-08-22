<?php

namespace app\models;

use app\base\UserBehavior;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            UserBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'password_hash', 'password_reset_token', 'auth_key'], 'string', 'max' => 255],
            [['username'], 'unique'],
            ['email', 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @return ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Option::class, ['user_id' => 'id'])->inverseOf('user');
    }

    /**
     * @return ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['name' => 'item_name'])
            ->viaTable('{{%auth_assignment}}', ['user_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::class, ['user_id' => 'id'])->inverseOf('user');
    }

    /**
     * @return ActiveQuery
     */
    public function getOpenAuths()
    {
        return $this->hasMany(OpenAuth::class, ['user_id' => 'id'])->inverseOf('user');
    }

    /**
     * @return ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['user_id' => 'id'])->inverseOf('user');
    }

    /**
     * @return ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::class, ['user_id' => 'id'])->inverseOf('user');
    }

    /************************* IdentityInterface methods *************************/

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::find()->where(['id' => $id])->active()->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
        throw new NotSupportedException();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /********************************* used by login form *********************************/

    /**
     * @param $username
     * @return User|null
     */
    public static function findByUsername($username)
    {
        return static::find()->where(['username' => $username])->active()->one();
    }

    /**
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

}
