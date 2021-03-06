<?php

use app\base\TimeAgoUtil;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

/* @var $inmailService \app\services\InmailService */
$inmailService = Yii::$app->get('inmailService');
$unreads = $inmailService->getUnreadInmails();
$unreadCount = count($unreads);

$userComp = Yii::$app->user;
$user = null;
$userProfile = null;
if(!$userComp->isGuest) {
    $user = $userComp->getIdentity();
    $userProfile = $user->userProfile;
}

$js_body_begin = <<<JS
function avatarError(image) {
    image.onerror = "";
    image.src = "$directoryAsset/img/user2-160x160.jpg";
    return true;
}
JS;
$this->registerJs($js_body_begin, View::POS_BEGIN);

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">YEA</span><span class="logo-lg">' . Yii::$app->name.'</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success <?= $unreadCount>0?'':'hidden' ?>">
                            <?= $unreadCount ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">
                            <?= $unreadCount>0?"You have $unreadCount inmails.":"You have no new inmails." ?>
                        </li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <!-- start message -->
                                <?php foreach ($unreads as $unread) { ?>
                                <li>
                                    <a href="/inmail-received/view?id=<?= $unread->id ?>">
                                        <div class="pull-left">
                                            <img src="<?= $unread->senderUser->userProfile->avatar ?>"
                                                 class="img-circle" alt="User Image"/>
                                        </div>
                                        <h4>
                                            <?= $unread->senderUser->username ?>
                                            <small>
                                                <i class="fa fa-clock-o"></i>
                                                <?= TimeAgoUtil::time_elapsed_string("@$unread->created_at") ?>
                                            </small>
                                        </h4>
                                        <p><?= $unread->subject ?></p>
                                    </a>
                                </li>
                                <?php } ?>
                                <!-- end message -->
                            </ul>
                        </li>
                        <li class="footer"><a href="/inmail-received/index">See All Inmails</a></li>
                    </ul>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may
                                        not fit into the page and may cause design problems
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> 5 new members joined
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> You changed your username
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Create a nice theme
                                            <small class="pull-right">40%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Some task I need to do
                                            <small class="pull-right">60%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-red" style="width: 60%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Make beautiful transitions
                                            <small class="pull-right">80%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if($userProfile) { ?>
                            <img src="<?= $userProfile->avatar ?>" class="user-image" alt="User Image"
                                 onerror="avatarError(this)"/>
                        <?php } else { ?>
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <?php } ?>
                        <span class="hidden-xs">
                            <?= Yii::$app->user->isGuest?'Not Login':Yii::$app->user->getIdentity()->username ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php if($userProfile) { ?>
                                <img src="<?= $userProfile->avatar ?>" class="img-circle" alt="User Image"
                                     onerror="avatarError(this)"/>
                            <?php } else { ?>
                                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                            <?php } ?>
                            <p>
                                <?= Yii::$app->user->isGuest?'Not Login':Yii::$app->user->getIdentity()->username ?>
                                <small><?=Yii::$app->user->isGuest?'':Yii::$app->user->getIdentity()->role->name?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
