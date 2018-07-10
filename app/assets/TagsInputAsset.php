<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-7-4
 * Time: 下午9:13
 */

namespace app\assets;


use yii\web\AssetBundle;

class TagsInputAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/bootstrap-tagsinput/bootstrap-tagsinput.css',
    ];
    public $js = [
        'resources/bootstrap-tagsinput/bootstrap-tagsinput.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}