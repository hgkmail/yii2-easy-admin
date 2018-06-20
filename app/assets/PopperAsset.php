<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-17
 * Time: 下午3:29
 */

namespace app\assets;


use kartik\base\AssetBundle;

class PopperAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'resources/popper.js/umd/popper.js',
        'resources/popper.js/umd/popper-utils.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}