<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-7
 * Time: 上午2:46
 */

namespace app\assets;


use yii\web\AssetBundle;

class StarRatingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/star-rating/css/star-rating.css',
    ];
    public $js = [
        'resources/star-rating/js/star-rating.js',
        'resources/star-rating/js/locales/zh.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}