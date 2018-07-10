<?php

use yii\web\View;

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

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if($userProfile) { ?>
                    <img src="<?= $userProfile->avatar ?>" class="img-circle" alt="User Image" onerror="avatarError(this)"/>
                <?php } else { ?>
                    <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                <?php } ?>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->isGuest?'Not Login':Yii::$app->user->getIdentity()->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= \app\widgets\MainMenu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => Yii::$app->get('mainMenuService')->getMenuItems(),
            ]
        ) ?>

    </section>

</aside>
