<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-7-5
 * Time: 下午8:13
 */

namespace app\assets;


use yii\web\AssetBundle;

class FileIconAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/file-icon-vectors/file-icon-vivid.css',
    ];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}