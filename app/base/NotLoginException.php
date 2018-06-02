<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-1
 * Time: 下午2:40
 */

namespace app\base;


use yii\base\UserException;

class NotLoginException extends UserException
{
    public function getName()
    {
        return 'Not Login';
    }
}