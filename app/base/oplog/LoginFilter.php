<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-19
 * Time: 下午6:30
 */

namespace app\base\oplog;

use app\models\OperationLog;
use Yii;
use yii\base\ActionFilter;

class LoginFilter extends ActionFilter
{
    public function afterAction($action, $result)
    {
        if(Yii::$app->request->isPost && !Yii::$app->user->getIsGuest()) {
            $log = OperationLog::withDefault();
            $log->user_id = Yii::$app->getUser()->getId();
            $username = Yii::$app->getUser()->getIdentity()->username;
            $log->description = "User $username is logged in.";
            $log->saveToLog();
        }

        return parent::afterAction($action, $result);
    }
}