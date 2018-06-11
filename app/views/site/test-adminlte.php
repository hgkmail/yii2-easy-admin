<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-5-26
 * Time: 下午5:05
 */

/* @var $this yii\web\View */

use lavrentiev\widgets\toastr\NotificationFlash;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\JsExpression;

$this->title = 'Test AdminLTE';
$this->params['breadcrumbs'][] = $this->title;

\app\assets\JqueryuiAsset::register($this);
//\app\assets\PaceAsset::register($this);
\app\assets\CropperAsset::register($this);
\app\assets\InputmaskAsset::register($this);
\app\assets\Select2Asset::register($this);
\app\assets\DatePickerAsset::register($this);
\app\assets\DateRangePickerAsset::register($this);
\app\assets\TimePickerAsset::register($this);
\app\assets\ColorPickerAsset::register($this);
\app\assets\StarRatingAsset::register($this);
\app\assets\FileInputAsset::register($this);
$this->registerJs(<<<JS
$('#section1').sortable()
JS
);

$css = <<<CSS
img {
  max-width: 100%;
}
CSS;
$this->registerCss($css);

$mceCallback = <<<JS
function mceCallback(editor) {
    editor.on('Change', function (event) {
        //console.log(editor.getContent());     // can't see text area 's content in dom debugger
        tinymce.triggerSave();
    });
  }
JS;
$this->registerJs($mceCallback, \yii\web\View::POS_END);

$boxRefresh=<<<JS
$("#first-box").boxRefresh({
  // The URL for the source.
  source: '/site/box',
  // GET query paramaters (example: {search_term: 'layout'}, which renders to URL/?search_term=layout).
  params: {name: 'def'},
  // The CSS selector to the refresh button.
  trigger: '#first-box .btn-refresh',
  // The CSS selector to the target where the content should be rendered. This selector should exist within the box.
  content: '#first-box .box-body',
  // Whether to automatically render the content.
  loadInContent: true,
  // Response type (example: 'json' or 'html')
  responseType: 'html',
  // The HTML template for the ajax spinner.
  overlayTemplate: '<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>',
  // Called before the ajax request is made.
  onLoadStart: function() {
    // Do something before sending the request.
  },
  // Called after the ajax request is made.
  onLoadDone: function(response) {
    // Do something after receiving a response.
    console.log(response)
  }
})

var cropper;

$('body').on('change', '#image-file', function(event) {
  var file = $('#image-file')[0].files[0];
  var reader = new FileReader();
    reader.onload=function(){
        // 通过 reader.result 来访问生成的 DataURL
        var url=reader.result;
        $('#image').attr('src', url);
        var image = document.getElementById('image');
        cropper = new Cropper(image, { aspectRatio: 1 / 1, crop: function(event) {
        }
        });
    };
    reader.readAsDataURL(file);
})

$('body').on('click', '#crop-image', function(event) {
    if (cropper) {
        var canvas = cropper.getCroppedCanvas({   // set final size
            width: 150,
            height: 150,
        });
        
        // Upload cropped image to server if the browser supports `HTMLCanvasElement.toBlob`
        canvas.toBlob(function (blob) {
          var formData = new FormData();
        
          formData.append('croppedImage', blob, $('#image-file')[0].files[0].name);
        
          // Use `jQuery.ajax` method
          $.ajax('/site/upload-avatar', {
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
              console.log('Upload success');
            },
            error: function () {
              console.log('Upload error');
            }
          });
        });
    } // end of if(cropper)
})

var selector = document.getElementById("my-inputmask");

var im = new Inputmask({'alias': 'email'});
im.mask(selector);

$('.js-example-basic-multiple').select2({
    width: 300
});

$('#datepicker').datepicker({
  autoclose: true
})

$('#reservation').daterangepicker({ timePicker: false, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })


$('.timepicker').timepicker({
  showInputs: false,
  minuteStep: 5,
})

$('.my-colorpicker1').colorpicker();

$("#star-rating").rating({'stars': 5, 'hoverChangeStars': false, 'showClear':false, 'showCaption': false}); 

$("#input-id").fileinput({showUpload:false, previewFileType:'any', overwriteInitial: false});
$('#input-id').on('fileloaded', function(event, file, previewId, index, reader) {
    // console.log("fileloaded", file, previewId, index, reader);
    if (file.crop) {
        return;
    }
    $('#cropper-modal').modal('toggle');
    $('#cropper-modal-img').prop('src', reader.result);
    cropper = new Cropper($('#cropper-modal-img')[0], { aspectRatio: 1 / 1, viewMode: 3, dragMode: 'move',
    crop: function(event) {
    }
    });
});
$('#cropper-modal').on('hidden.bs.modal', function(e) {
    if(cropper) {
        cropper.destroy();
    }
});
$('body').on('click', '#cropper-modal-ok', function() {
    if(cropper) {
        var canvas = cropper.getCroppedCanvas({   // set final size
            width: 150,
            height: 150,
        });
        var dataurl = canvas.toDataURL();
        $("#input-id").fileinput('destroy').fileinput({
            showUpload:false, previewFileType:'any', overwriteInitial: false,
            initialPreview: [dataurl],
            initialPreviewAsData: true,
            initialPreviewConfig: [
                {caption: "aaa.jpg", width: "150px", height: "150px", key: 1, data: canvas, url: false}
            ],
        });
      
    }
});

$('body').on('click', '.file-preview-frame', function() {
    // alert($(this).find('.file-caption-info').text());
});

$('body').on('click', '#select-user', function(event) {
  alert(JSON.stringify(window.frames['frame1'].getSelectedRows()));   // call iframe's js method
})
  
JS;
$this->registerJs($boxRefresh);

?>

<?php Modal::begin([
        'id' => 'cropper-modal',
        'header' => '<h4>Crop Image</h4>',
        'footer' => '<button type="button" id="cropper-modal-cancel" data-dismiss="modal">Cancel</button>
                    <button type="button" id="cropper-modal-ok" data-dismiss="modal">OK</button>'
]) ?>
<img src="" alt="" id="cropper-modal-img">
<?php Modal::end() ?>

<?= NotificationFlash::widget([
        'options' => ['closeButton' => true, 'progressBar' => true],
]) ?>

<?php Modal::begin([
        'header' => '<h4>Select User</h4>',
        'footer' => '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary" id="select-user" data-dismiss="modal">OK</button>',
        'id' => 'iframe-modal',
        'size' => Modal::SIZE_LARGE,
]) ?>
<div class="fluidMedia">
    <iframe src="/user/pick" frameborder="0" scrolling="no" name="frame1">
    </iframe>
</div>
<?php Modal::end() ?>

<div class="row">
    <div class="col-md-4">
        <button type="button" data-toggle="modal" data-target="#iframe-modal">iframe</button>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <input id="input-id" type="file" multiple="multiple" name="myfiles[]">
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <input id="star-rating" type="text">
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Color picker:</label>
            <input type="text" class="form-control my-colorpicker1">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" class="form-control timepicker">
            <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="reservation">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="datepicker">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
            <option value="CN">China</option>
            <option value="TW">Taiwan</option>
            <option value="US">US</option>
            <option value="UK">UK</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <input type="text" class="form-control" id="my-inputmask">
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= Html::beginForm('#', 'post') ?>
        <?php //\bizley\quill\Quill::widget([
            //'name' => 'content',
            //'id' => 'quill-editor',
        //]) ?>
        <?= Html::endForm() ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= Html::beginForm('#', 'post') ?>
        <?php //\dosamigos\ckeditor\CKEditor::widget([
            //'options' => ['rows' => 6],
            //'preset' => 'full',
            //'id' => 'my-ckeditor',
            //'name' => 'content',
        //]) ?>
        <?= Html::endForm() ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= Html::beginForm('#', 'post') ?>
        <?php \dosamigos\tinymce\TinyMce::widget([
                'options' => [
                        'row' => 6,
                        'id' => 'tiny-editor',
                ],
                'language' => 'zh_CN',
                'name' => 'content',
            'clientOptions' => [
                'plugins' => [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | 
                bullist numlist outdent indent | link image",
                'init_instance_callback' => new JsExpression('mceCallback'),
            ],
        ]) ?>
        <?= Html::endForm() ?>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <img id="image" src="">
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <input type="file" id="image-file">
        <button type="button" id="crop-image">crop and upload</button>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <a type="button" class="btn btn-primary btn-flat" data-confirm="Are you sure?" href="http://www.baidu.com">say hello</a>

    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h3>tree</h3>
        <ul data-widget="tree" class="sidebar-menu">
            <li class="header">header</li>
            <li class="active"><a href="#">aaa</a></li>
            <li class="treeview"><a href="#">bbb</a>
                <ul class="treeview-menu">
                    <li><a href="#">xxx</a></li>
                    <li><a href="#">yyy</a></li>
                </ul>
            </li>
            <li class="treeview"><a href="#">multi</a>
                <ul class="treeview-menu">
                    <li><a href="#">ddd</a></li>
                    <li><a href="#">eee</a></li>
                    <li class="treeview"><a href="#">more</a>
                        <ul class="treeview-menu">
                            <li><a href="#">111</a></li>
                            <li><a href="#">222</a></li>
                            <li><a href="#">333</a></li>
                        </ul>
                    </li>
                    <li><a href="#">fff</a></li>
                </ul>
            </li>
            <li><a href="#">ccc</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h3>push menu</h3>
        <button class="btn btn-primary" data-toggle="push-menu">Toggle Sidebar</button>
        <h3>push control sidebar</h3>
        <a href="#" data-toggle="control-sidebar">Toggle Control Sidebar</a>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h3>box</h3>
        <section id="section1" class="ui-sortable">
            <div class="box box-solid box-primary" id="first-box">
                <div class="box-header ui-sortable-handle">
                    <h4 class="box-title">
                        Title
                    </h4>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool btn-success" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-box-tool btn-danger btn-refresh"><i class="fa fa-refresh"></i></button>
                        <div class="btn-group">
                            <button class="btn btn-box-tool dropdown-toggle btn-danger" data-toggle="dropdown"><i class="fa fa-magic"></i></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">aaa</a></li>
                                <li><a href="#">bbb</a></li>
                                <li><a href="#">ccc</a></li>
                            </ul>
                        </div>

                        <button class="btn btn-box-tool btn-warning" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    body
                </div>
                <div class="box-footer">
                    footer
                </div>
                <!--        <div class="overlay">-->
                <!--            <i class="fa fa-refresh fa-spin"></i>-->
                <!--        </div>-->
            </div>
            <div class="box box-success">
                <div class="box-header">
                    <h4 class="box-title">ttt</h4>
                    <div class="box-tools pull-right">
                        <span class="badge">4</span>
                    </div>
                </div>
                <div class="box-body">
                    body
                </div>
                <div class="box-footer">
                    footer
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-circle-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">aaa</span>
                <span class="info-box-number">111</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-star-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">aaa</span>
                <span class="info-box-number">111</span>
                <div class="progress">
                    <span class="progress-bar" style="width:70%"></span>
                </div>
                <span class="progress-description">ddd</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>inner</h3>
                <p>abcdef</p>
            </div>
            <div class="icon"><i class="fa fa-magic"></i></div>
            <a href="" class="small-box-footer">more&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Direct Chat</h3>
                <div class="box-tools pull-right">
                    <span class="badge" title="3 new messages">3</span>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="direct-chat-messages">
                    <!-- left msg -->
                    <div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left">00</span>
                            <span class="direct-chat-timestamp pull-right">2018-5-29</span>
                        </div>
                        <img class="direct-chat-img" src="/upload/avatar/00.jpg" alt="avatar">
                        <div class="direct-chat-text">hello</div>
                    </div>
                    <!-- right msg -->
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-right">Kim</span>
                            <span class="direct-chat-timestamp pull-left">2018-5-29</span>
                        </div>
                        <img class="direct-chat-img" src="/upload/avatar/cat.jpg" alt="avatar">
                        <div class="direct-chat-text">hi</div>
                    </div>
                </div>
                <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="/upload/avatar/00.jpg" alt="avatar">
                                <div class="contacts-list-info">
                                    <span class="contacts-list-name">00
                                        <small class="contacts-list-date pull-right">2019-5-29</small>
                                    </span>
                                    <span class="contacts-list-msg">hello</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="/upload/avatar/cat.jpg" alt="avatar">
                                <div class="contacts-list-info">
                                    <span class="contacts-list-name">Kim
                                        <small class="contacts-list-date pull-right">2019-5-29</small>
                                    </span>
                                    <span class="contacts-list-msg">hi</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-footer">
                <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-btn"><button class="btn btn-primary btn-flat">Send</button></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#tab2" data-toggle="tab">tab2</a></li>
                <li><a href="#tab1" data-toggle="tab">tab1</a></li>
                <li class="header pull-left">tabs</li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab1" style="height: 100px">tab1</div>
                <div class="tab-pane active" id="tab2" style="height: 100px">tab2</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <ul class="timeline">
            <li class="time-label"><span class="bg-green">2018-5-29</span></li>
            <li>
                <i class="fa fa-envelope bg-blue"></i>
                <div class="timeline-item">
                    <span class="time">12:05</span>
                    <h3 class="timeline-header text-blue">header</h3>
                    <div class="timeline-body">body</div>
                    <div class="timeline-footer">footer</div>
                </div>
            </li>
            <li>
                <i class="fa fa-edit bg-red"></i>
                <div class="timeline-item">
                    <span class="time">14:05</span>
                    <h3 class="timeline-header text-red">header</h3>
                    <div class="timeline-body">body</div>
                    <div class="timeline-footer">footer</div>
                </div>
            </li>
            <li class="time-label"><span class="bg-red">2018-5-30</span></li>
        </ul>
    </div>
</div>

