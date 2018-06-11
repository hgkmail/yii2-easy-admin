<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-7
 * Time: 上午12:32
 */

namespace app\assets;


use yii\web\AssetBundle;

class DateRangePickerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/daterangepicker/daterangepicker.css',
    ];
    public $js = [
        'resources/daterangepicker/moment.min.js',
        'resources/daterangepicker/daterangepicker.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}