<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-5-31
 * Time: 上午5:14
 */

namespace app\services;


use app\models\Role;
use app\models\User;
use Yii;
use yii\base\Component;

class UserService extends Component
{
    /**
     * Add a user
     * @param $username
     * @param $email
     * @param $password
     * @return User
     * @throws
     */
    public function register($username, $email, $password)
    {
        $newUser = new User();
        $newUser->username = $username;
        $newUser->email = $email;
        $newUser->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
        $newUser->password_reset_token = Yii::$app->getSecurity()->generateRandomString(4);
        $newUser->auth_key = Yii::$app->getSecurity()->generateRandomString(8);
        $newUser->status = User::STATUS_ENABLED;
        $newUser->save();
        $subscriber = Yii::$app->authManager->getRole('subscriber');
        Yii::$app->authManager->assign($subscriber, $newUser->id);
        return $newUser;
    }

    /**
     * Check if username exists
     * @param $username
     * @return boolean
     */
    public function exist($username)
    {
        $count = User::find()->where(['username' => $username])->count();
        return $count > 0;
    }


}