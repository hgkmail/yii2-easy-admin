<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-17
 * Time: 下午9:15
 */

namespace app\assets;


use yii\web\AssetBundle;

class EmojiOneAsset extends AssetBundle
{
    public $css = [
        'https://cdn.jsdelivr.net/npm/emojione@3.1.5/extras/css/emojione.min.css',
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/emojione@3.1.5/lib/js/emojione.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}