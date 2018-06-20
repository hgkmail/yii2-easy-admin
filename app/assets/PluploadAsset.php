<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-15
 * Time: 上午5:26
 */

namespace app\assets;


use yii\web\AssetBundle;

class PluploadAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'resources/plupload/js/plupload.full.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}