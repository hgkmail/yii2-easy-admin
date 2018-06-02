<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-2
 * Time: 下午8:00
 */

namespace app\models\form;


use app\models\User;
use yii\base\Model;

/**
 * Class UserCreateForm
 * @package app\models\form
 */
class RegisterForm extends Model
{
    const SCENARIO_REGISTER = 'register';                // register
    const SCENARIO_CREATE = 'create';                    // create user
    const SCENARIO_UPDATE = 'update';                    // update user

    public $username;
    public $email;
    public $password;
    public $passwordRepeat;
    public $status;

    /**
     * @var User
     */
    private $_user = false;  // not attribute

    public function rules()
    {
        return [
            // pattern
            ['username', 'match', 'pattern' => '/^[a-zA-Z]\w*$/i'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            // register
            [['username', 'email', 'password', 'passwordRepeat'], 'required', 'on' => static::SCENARIO_REGISTER],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'on' => static::SCENARIO_REGISTER],
            // create user
            [['username', 'email', 'password', 'status'], 'required', 'on' => static::SCENARIO_CREATE],
            // update user
            [['username', 'email', 'status'], 'required', 'on' => static::SCENARIO_UPDATE],
            ['password', 'safe', 'on' => static::SCENARIO_UPDATE],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => \Yii::t('app', 'Username'),
            'email' => \Yii::t('app', 'Email'),
            'password' => \Yii::t('app', 'Password'),
            'passwordRepeat' => \Yii::t('app', 'Retype Password'),
            'status' => \Yii::t('app', 'Status'),
        ];
    }

    public function validateUsername()
    {
        $userService = \Yii::$app->get('userService');

        if ($userService->exist($this->username)) {
            // special
            if ($this->_user != false && $this->username == $this->_user->username) {
                return true;
            }
            $this->addError('username', \Yii::t('app','Username is existing'));
            return false;
        }
        return true;
    }

    /**
     * After validation
     * @return User
     */
    public function register()
    {
        $userService = \Yii::$app->get('userService');
        return $userService->register($this->username, $this->email, $this->password);
    }

    /**
     * After validation
     * @return User
     * @throws
     */
    public function createUser()
    {
        $newUser = new User();
        $newUser->username = $this->username;
        $newUser->email = $this->email;
        $newUser->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $newUser->password_reset_token = \Yii::$app->getSecurity()->generateRandomString(4);
        $newUser->auth_key = \Yii::$app->getSecurity()->generateRandomString(8);
        $newUser->status = $this->status;
        $newUser->save();
        return $newUser;
    }

    public function setUser($user)
    {
        $this->_user = $user;

        $this->username = $this->_user->username;
        $this->email = $this->_user->email;
        $this->status = $this->_user->status;
        $this->password = '';
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * After validation
     */
    public function updateUser()
    {
        $this->_user->username = $this->username;
        $this->_user->email = $this->email;
        $this->_user->status = $this->status;
        if(!empty($this->password)) {
            $this->_user->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }
        $this->_user->save();
    }

}