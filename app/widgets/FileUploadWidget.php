<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-11
 * Time: 上午1:02
 */

namespace app\widgets;


use app\assets\FileInputAsset;
use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * Class FileUploadWidget
 * A text input to store file url and a file input to store file,
 * text input is main input, file input is assist input,
 * file input will use FormData to ajax upload file at once, then text input get the url of file.
 * @package app\widgets
 */
class FileUploadWidget extends InputWidget
{
    public $id;

    public $fileInputId;

    public $category = 'temp';

    public $useCropModal = 0;

    public $idAttribute = '';

    public $allowExt = [];

    public function init()
    {
        parent::init();
        if(empty($this->id)) {
            $this->id = "$this->attribute-url";              // default text input id
        }
        if(empty($this->fileInputId)) {
            $this->fileInputId = "$this->attribute-file";    // default file input id
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerClientScript();

        $opt = ['type' => 'hidden', 'id' => $this->id];
        $opt = array_merge($this->options, $opt);
        $result = Html::activeTextInput($this->model, $this->attribute, $opt);
        $result = $result."<input type='file' id='$this->fileInputId'>";        // file input without name

        return $result;
    }

    public function registerClientScript()
    {
        $view = $this->view;
        $attribute = $this->attribute;
        $idAttr = $this->idAttribute;
        $modelId = empty($idAttr) ? 0 : $this->model->$idAttr;
        $allowExt = empty($this->allowExt)?'null':json_encode($this->allowExt);
        FileInputAsset::register($view);

        $oldfile = $this->model->$attribute;
        $Js = <<<JS
        
// use crop modal
function useCropModal(event, file, previewId, index, reader) {
    $('#crop-modal').modal('toggle');
    $('#crop-modal-img').prop('src', reader.result);
    $('body').on('click', '#crop-modal-ok', function() {
        if(window.yeaCrop) {
            var canvas = window.yeaCrop.getCroppedCanvas({   // set final size
                width: 300,
                height: 300,
            });
            canvas.toBlob(function(blob) {
                blob.name = file.name;
                blob.type = file.type;
                blob.lastModified = file.lastModified;
                blob.lastModifiedDate = file.lastModifiedDate;
                $("#$this->fileInputId").fileinput('updateStack', index, blob);
                $('#$this->fileInputId').fileinput('upload');
                $('#crop-modal').modal('toggle');
            });
        }
    });
    $('body').on('click', '#crop-modal-cancel', function() {
        $('#$this->fileInputId').fileinput('clear');
        $('#crop-modal').modal('toggle');
    });
}
        
// init Bootstrap file input
var ${attribute}FileInputOpt = {
    defaultPreviewContent: '<img src="/upload/avatar/default_avatar_male.jpg" alt="Your Avatar">',
    allowedFileExtensions: $allowExt,
    uploadUrl: '/site/upload',
    initialPreviewAsData: true,
    uploadExtraData: {
        category: '$this->category',
        oldfile: '$oldfile',
        modelId: '$modelId',
    },
    uploadClass: 'hidden',
    removeClass: 'hidden',
    fileActionSettings: {
        showDrag: false,
        showRemove: false,
        showDownload: false,
        showUpload: false,
    }
};
if('$oldfile'!='') {
     ${attribute}FileInputOpt.initialPreview = ['$oldfile'];
}
$('#$this->fileInputId').fileinput(${attribute}FileInputOpt);

// handle event
$('#$this->fileInputId').on('fileloaded', function(event, file, previewId, index, reader) {
    // console.log('fileloaded', event, file);
    if ($this->useCropModal == 0) {
        $('#$this->fileInputId').fileinput('upload');   // upload at once
    } else {
        useCropModal(event, file, previewId, index, reader);
    }
});      
$('#$this->fileInputId').on('fileuploaded', function(event, data, previewId, index) {
    // console.log('fileuploaded', data);
    if(data.response && data.response.code==200) {
        $('#$this->id').val(data.response.data);
        // update file input after 1s (because of progress animation)
        ${attribute}FileInputOpt.uploadExtraData.oldfile = data.response.data;
        ${attribute}FileInputOpt.initialPreview = [data.response.data];
        setTimeout(function() {
            $('#$this->fileInputId').fileinput('destroy').fileinput(${attribute}FileInputOpt);
        }, 1000);
    } else {
        alert('Fail to upload $attribute');
    }
});
$('#$this->fileInputId').on('fileuploaderror', function(event, data, msg) {
    alert('Fail to upload $attribute');
});

JS;

        $view->registerJs($Js);
    }
}