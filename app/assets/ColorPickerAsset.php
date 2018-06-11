<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-7
 * Time: 上午2:39
 */

namespace app\assets;


use yii\web\AssetBundle;

class ColorPickerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/colorpicker/css/bootstrap-colorpicker.css',
    ];
    public $js = [
        'resources/colorpicker/js/bootstrap-colorpicker.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}