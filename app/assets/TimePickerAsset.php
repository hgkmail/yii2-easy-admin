<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-7
 * Time: 上午12:44
 */

namespace app\assets;


use yii\web\AssetBundle;

class TimePickerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/timepicker/css/bootstrap-timepicker.css',
    ];
    public $js = [
        'resources/timepicker/js/bootstrap-timepicker.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}