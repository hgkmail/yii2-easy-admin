<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-22
 * Time: 下午6:14
 */

namespace app\assets;


use yii\web\AssetBundle;

class FaIconPickerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/fontawesome-iconpicker/css/fontawesome-iconpicker.min.css',
        'https://use.fontawesome.com/releases/v5.0.8/css/all.css',    // font-awesome v5
    ];
    public $js = [
        'resources/fontawesome-iconpicker/js/fontawesome-iconpicker.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}