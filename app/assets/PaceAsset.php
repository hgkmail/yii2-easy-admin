<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-5-29
 * Time: 下午7:22
 */

namespace app\assets;


use yii\web\AssetBundle;

class PaceAsset extends AssetBundle
{
    public $sourcePath = "@vendor/almasaeed2010/adminlte/plugins/";
    public $css = [
      "pace/pace.css"
    ];
    public $js = [
        "pace/pace.js"
    ];
}