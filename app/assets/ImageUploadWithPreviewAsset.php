<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-7-2
 * Time: 下午3:07
 */

namespace app\assets;


use yii\web\AssetBundle;

class ImageUploadWithPreviewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resources/my-jq-plugin/image-upload-with-preview/image-upload-with-preview.less',   // less
    ];
    public $js = [
        'resources/my-jq-plugin/image-upload-with-preview/image-upload-with-preview.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}