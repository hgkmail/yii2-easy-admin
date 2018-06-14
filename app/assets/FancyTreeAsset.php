<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-12
 * Time: 上午2:45
 */

namespace app\assets;


use yii\web\AssetBundle;

class FancyTreeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/fancytree/skin-vista/ui.fancytree.min.css',
    ];
    public $js = [
        'resources/fancytree/jquery.fancytree.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\app\assets\JqueryuiAsset',
    ];
}