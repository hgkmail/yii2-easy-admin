<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-20
 * Time: 下午6:55
 */

namespace app\services;


use app\models\InmailReceived;
use yii\base\Component;

class InmailService extends Component
{
    /**
     * @return InmailReceived[]
     * @throws \Exception
     * @throws \Throwable
     */
    public function getUnreadInmails()
    {
        if(\Yii::$app->user->getIsGuest()) {
            return [];
        }
        $uname = \Yii::$app->user->getIdentity()->username;
        $unreads = InmailReceived::find()->with('senderUser.userProfile')
            ->andWhere(['receiver' => $uname])
            ->andWhere(['read_at' => 0])->all();
        return $unreads;
    }
}