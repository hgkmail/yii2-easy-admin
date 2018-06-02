<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-3
 * Time: 上午4:18
 */

namespace app\assets;


use yii\web\AssetBundle;

class iCheckAsset extends AssetBundle
{
    public $sourcePath = "@vendor/almasaeed2010/adminlte/plugins/";
    public $css = [
        'iCheck/square/blue.css'
    ];
    public $js = [
        'iCheck/icheck.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}