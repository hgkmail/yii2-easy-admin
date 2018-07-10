<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-22
 * Time: 下午6:05
 */

namespace app\assets;


use yii\web\AssetBundle;

class NumberInputAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'resources/bootstrap-number-input/bootstrap-number-input.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}