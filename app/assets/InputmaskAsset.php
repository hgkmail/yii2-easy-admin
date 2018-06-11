<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-6
 * Time: 下午7:22
 */

namespace app\assets;


use yii\web\AssetBundle;

class InputmaskAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'resources/inputmask/jquery.inputmask.bundle.js',
        'resources/inputmask/inputmask/phone-codes/phone.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}