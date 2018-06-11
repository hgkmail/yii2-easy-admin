<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-7
 * Time: 上午4:29
 */

namespace app\assets;


use yii\web\AssetBundle;

class FileInputAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/fileinput/css/fileinput.css',
    ];
    public $js = [
        'resources/fileinput/js/plugins/piexif.js',
        'resources/fileinput/js/plugins/purify.js',
        'resources/fileinput/js/plugins/sortable.js',
        'resources/fileinput/js/fileinput.js',
        'resources/fileinput/js/locales/zh.js',
        'resources/fileinput/themes/explorer/theme.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}