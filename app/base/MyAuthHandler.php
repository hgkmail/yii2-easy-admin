<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-19
 * Time: 上午3:45
 */

namespace app\base;


use app\models\OpenAuth;
use app\models\User;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

class MyAuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        $attributes = $this->client->getUserAttributes();
        $id = ArrayHelper::getValue($attributes, 'id');
        $nickname = ArrayHelper::getValue($attributes, 'login');

        /* @var OpenAuth $auth */
        $auth = OpenAuth::find()->where([
            'source' => $this->client->getId(),
            'source_id' => strval($id),
        ])->one();

        if(\Yii::$app->user->isGuest) {    // not login
            if($auth) {
                $user = $auth->user;
                \Yii::$app->user->login($user, 3600*24);  // remember me by one day
            } else {
                \Yii::$app->session->addFlash('error', 'Can not find a linked user.');
            }
        } else {                           // has login
            if(!$auth) {
                $auth = new OpenAuth([
                    'user_id' => \Yii::$app->user->id,
                    'source' => $this->client->getId(),
                    'source_id' => strval($id),
                ]);
                if ($auth->save()) {
                    \Yii::$app->getSession()->setFlash('success', [
                        \Yii::t('app', 'Linked {client} account.', [
                            'client' => $this->client->getTitle()
                        ]),
                    ]);
                } else {
                    \Yii::$app->getSession()->setFlash('error', [
                        \Yii::t('app', 'Unable to link {client} account: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($auth->getErrors()),
                        ]),
                    ]);
                }
            } else {
                /** @var User $user */
                $user = $auth->user;
                if($user->id == \Yii::$app->user->id) {
                    \Yii::$app->getSession()->setFlash('info', [
                        \Yii::t('app', 'Have linked {client} account before.', [
                            'client' => $this->client->getTitle()
                        ]),
                    ]);
                } else {
                    \Yii::$app->getSession()->setFlash('error', [
                        \Yii::t('app',
                            'Unable to link {client} account. There is another user using it.',
                            ['client' => $this->client->getTitle()]),
                    ]);
                }
            }
        }
    }


    public function handle2()
    {
        var_dump($this->client->getId());              // github
//        var_dump($this->client->getName());            // github
//        var_dump($this->client->getTitle());           // Github
//        var_dump($this->client->getViewOptions());     // []
        var_dump($this->client->getUserAttributes());
    }

}