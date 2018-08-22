<?php

/* @var $this yii\web\View */
/* @var $statMap array */

use app\widgets\SmallBoxWidget;

$this->title = 'Dashboard ( update per hour )';
?>
<div class="site-index container-fluid">
    <div class="site-stat row">
        <div class="col-md-3">
            <?= SmallBoxWidget::widget([
                'number'=>$statMap['total-user'],
                'title'=>'Users',
                'moreButton'=>['label'=>'More info', 'url'=>'/user/index'],
                'icon'=>'fa fa-user',
                'color'=>'bg-green',
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= SmallBoxWidget::widget([
                'number'=>$statMap['total-role'],
                'title'=>'Roles',
                'moreButton'=>['label'=>'More info', 'url'=>'/role/index'],
                'icon'=>'fa fa-users',
                'color'=>'bg-yellow',
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= SmallBoxWidget::widget([
                'number'=>$statMap['total-menu'],
                'title'=>'Menus',
                'moreButton'=>['label'=>'More info', 'url'=>'/menu/index'],
                'icon'=>'fa fa-navicon',
                'color'=>'bg-aqua',
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= SmallBoxWidget::widget([
                'number'=>$statMap['total-feedback'],
                'title'=>'Feedbacks',
                'moreButton'=>['label'=>'More info', 'url'=>'/feedback/index'],
                'icon'=>'fa fa-comment',
                'color'=>'bg-red',
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>REST API Endpoints</h4>
            <pre>User: /v1/users</pre>
            <pre>Role: /v1/roles</pre>
            <pre>Post: /v1/posts</pre>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>Open Auth</h4>
            <?= yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['site/auth'],
                'popupMode' => false,
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>TODO</h4>
            <p>graph ( by time ), calendar, quick editor, chatbox, etc.</p>
        </div>
    </div>
</div>
