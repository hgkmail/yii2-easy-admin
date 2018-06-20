<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-19
 * Time: 上午1:49
 */

/* @var $this yii\web\View */

$this->title = 'Test OAuth2 Client';
$this->params['breadcrumbs'][] = $this->title;

$clientId = Yii::$app->params['github_client_id'];
$clientSecret = Yii::$app->params['github_client_secret'];

?>

<p>
    We're going to now talk to the GitHub API. Ready?
    <a href="https://github.com/login/oauth/authorize?scope=user:email&client_id=<?= $clientId ?>">Click here</a> to begin!</a>
</p>
<p>
    <?= yii\authclient\widgets\AuthChoice::widget([
        'baseAuthUrl' => ['site/auth'],
        'popupMode' => false,
    ]) ?>
</p>
