<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-22
 * Time: 下午6:46
 */

namespace app\assets;


use yii\web\AssetBundle;

class NestableAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/nestable/nestable-demo.css'
    ];
    public $js = [
        'resources/nestable/jquery.nestable.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}