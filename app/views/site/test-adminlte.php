<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-5-26
 * Time: 下午5:05
 */

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Test AdminLTE';
$this->params['breadcrumbs'][] = $this->title;

\app\assets\JqueryuiAsset::register($this);
\app\assets\PaceAsset::register($this);
$this->registerJs(<<<JS
$('#section1').sortable()
JS
);

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

JS;
$this->registerJs($boxRefresh);

?>
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

