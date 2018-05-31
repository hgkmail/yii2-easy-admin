<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-5-28
 * Time: 下午7:55
 */

namespace app\assets;


use yii\web\AssetBundle;

class JqueryuiAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/jQueryUI';
    public $css = [];
    public $js = [
        'jquery-ui.min.js'
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset'
    ];
}