<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-11
 * Time: 上午5:01
 */

namespace app\widgets;


use app\assets\CropperAsset;
use yii\base\Widget;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/**
 * Class CropModal
 * Only need one crop modal.
 * @package app\widgets
 */
class CropModal extends Widget
{
    public $id = 'crop-modal';

    public $header = '<h4>Crop Image</h4>';

    public $footer = '<button id="crop-modal-cancel" type="button" class="btn btn-default pull-left">Cancel</button>
                      <button id="crop-modal-ok" type="button" class="btn btn-primary">OK</button>';

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->registerClientScript();

        Modal::begin(['id' => $this->id, 'header' => $this->header, 'footer' => $this->footer,
            'closeButton' => false, 'size' => 'modal-lg',
            'options' => ['data-keyboard' => 'false']]);
        $html = <<<HTML
<div class="row">
    <div class="col-md-5 col-md-offset-1 crop-modal-container">
        <img src="" alt="" id="crop-modal-img">
    </div>
    <div class="col-md-4">
        <div class="crop-modal-preview md pull-left"></div>
        <div class="crop-modal-preview sm pull-left"></div>
        <div class="crop-modal-preview xs pull-left"></div>
    </div> 
</div>
HTML;
        echo $html;
        Modal::end();
    }

    public function registerClientScript()
    {
        $view = $this->view;
        CropperAsset::register($view);

        $js = <<<JS
// global crop instance
window.yeaCrop = null;

// init after shown
$('#crop-modal').on('shown.bs.modal', function() {
    window.yeaCrop = new Cropper($('#crop-modal-img')[0], { 
        minContainerWidth: 300, minContainerHeight: 300, preview: '.crop-modal-preview',
        aspectRatio: 1 / 1, viewMode: 3, dragMode: 'move',
        ready: function() {
        }, 
        crop: function(event) {
        }
    });
});

// cleanup after hidden
$('#crop-modal').on('hidden.bs.modal', function() {
    if(window.yeaCrop) {
        window.yeaCrop.destroy(); 
        window.yeaCrop = null;
    }
    $('body').off('click', '#crop-modal-ok');
    $('body').off('click', '#crop-modal-cancel');
    $('#crop-modal-img').prop('src', '');
});
JS;
        $view->registerJs($js);
    }
}