<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-3
 * Time: 上午2:49
 */

namespace app\base;


use yii\base\ActionFilter;

class ExceptionFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        if(\Yii::$app->errorHandler->exception instanceof NotLoginException) {
            \Yii::$app->user->logout();
            \Yii::$app->response->redirect('/site/login');
            return false;
        }
        else {
            return parent::beforeAction($action);
        }

    }
}