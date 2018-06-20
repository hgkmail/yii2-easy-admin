<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-15
 * Time: 上午4:33
 */

namespace app\assets;


use yii\web\AssetBundle;

class JqueryFileUploadAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/jQuery-File-Upload/css/jquery.fileupload.css',
    ];
    public $js = [
        'resources/jQuery-File-Upload/js/jquery.fileupload.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\app\assets\JqueryuiAsset',
    ];
}