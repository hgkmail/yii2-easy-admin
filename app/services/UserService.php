<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-5-31
 * Time: 上午5:14
 */

namespace app\services;


use app\models\User;
use yii\base\Component;

class UserService extends Component
{
    /**
     * Add a user
     * @param $username
     * @param $email
     * @param $password
     * @throws
     */
    public function register($username, $email, $password)
    {
        $newUser = new User();
        $newUser->username = $username;
        $newUser->email = $email;
        $newUser->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($password);
        $newUser->password_reset_token = \Yii::$app->getSecurity()->generateRandomString(4);
        $newUser->auth_key = \Yii::$app->getSecurity()->generateRandomString(8);
        $newUser->status = User::STATUS_ENABLED;
        $newUser->save();
    }
}