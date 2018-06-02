<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-3
 * Time: 上午1:16
 */

namespace app\base;


use yii\base\UserException;

class ExistException extends UserException
{
    public function getName()
    {
        return 'Exist';
    }
}