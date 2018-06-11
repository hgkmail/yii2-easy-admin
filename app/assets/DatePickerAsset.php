<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-7
 * Time: 上午12:14
 */

namespace app\assets;


use yii\web\AssetBundle;

class DatePickerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/datepicker/css/bootstrap-datepicker.css',
    ];
    public $js = [
        'resources/datepicker/js/bootstrap-datepicker.js',
        'resources/datepicker/locales/bootstrap-datepicker.zh-CN.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}