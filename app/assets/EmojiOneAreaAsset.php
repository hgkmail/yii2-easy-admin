<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-18
 * Time: 下午5:55
 */

namespace app\assets;


use yii\web\AssetBundle;

class EmojiOneAreaAsset extends AssetBundle
{
    public $sourcePath = '@vendor/mervick/emojionearea/dist';
    public $css = [
        'emojionearea.css',
    ];
    public $js = [
        'emojionearea.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}