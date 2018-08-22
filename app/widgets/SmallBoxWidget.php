<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-8-21
 * Time: 下午8:35
 */

namespace app\widgets;


use yii\jui\Widget;

class SmallBoxWidget extends Widget
{
    public $number=1;

    public $title="Item";

    public $moreButton=[
        'label' => 'More info',
        'url' => '/',
    ];

    public $icon='fa fa-circle';

    public $color='bg-aqua';

    public function run()
    {
        $moreButtonLabel = $this->moreButton['label'];
        $moreButtonUrl = $this->moreButton['url'];

        $html=<<<HTML
<!-- small box begin -->
<div class="small-box $this->color">
    <div class="inner">
        <h3>$this->number</h3>
        <p>$this->title</p >
    </div>
    <div class="icon">
        <i class="$this->icon"></i>
    </div>
    <a href="$moreButtonUrl" class="small-box-footer">$moreButtonLabel <i class="fa fa-arrow-circle-right"></i></a >
</div>
<!-- small box end -->
HTML;
        echo $html;
    }
}