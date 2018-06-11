<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-5
 * Time: 上午1:04
 */

namespace app\base;


use yii\base\Behavior;
use yii\db\BaseActiveRecord;

/**
 * Add event handlers for Class User
 *
 * @package app\base
 */
class UserBehavior extends Behavior
{
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete'
        ];
    }

    public function beforeDelete($event)
    {
        /* @var $user \app\models\User */
        $user = $this->owner;

        $auth = \Yii::$app->authManager;
        $roles = $auth->getRolesByUser($user->id);
        if(!empty($roles)) {
            foreach ($roles as $k => $v) {
                $auth->revoke($v, $user->id);
            }
        }
    }
}