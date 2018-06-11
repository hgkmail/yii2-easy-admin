<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-6
 * Time: 上午3:05
 */

namespace app\assets;


use yii\web\AssetBundle;

class CropperAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/cropperjs/dist/cropper.css',
    ];
    public $js = [
        'resources/cropperjs/dist/cropper.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}