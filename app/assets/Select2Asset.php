<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-6
 * Time: 下午8:00
 */

namespace app\assets;


use yii\web\AssetBundle;

class Select2Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/select2/css/select2.css',
    ];
    public $js = [
        'resources/select2/js/select2.js',
        'resources/select2/js/i18n/zh-CN.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}