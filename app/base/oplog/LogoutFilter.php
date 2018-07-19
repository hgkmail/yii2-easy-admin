<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-19
 * Time: 下午7:03
 */

namespace app\base\oplog;


use app\models\OperationLog;
use Yii;
use yii\base\ActionFilter;

class LogoutFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        if(!Yii::$app->getUser()->getIsGuest()) {
            $log = OperationLog::withDefault();
            $log->user_id = Yii::$app->getUser()->getId();
            $username = Yii::$app->getUser()->getIdentity()->username;
            $log->description = "User $username is logged out.";
            $log->saveToLog();
        }
        return parent::beforeAction($action);
    }
}