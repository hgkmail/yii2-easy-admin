<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-19
 * Time: 上午3:45
 */

namespace app\base;


use yii\authclient\ClientInterface;

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
        var_dump($this->client->getId());              // github
//        var_dump($this->client->getName());            // github
//        var_dump($this->client->getTitle());           // Github
//        var_dump($this->client->getViewOptions());     // []
        var_dump($this->client->getUserAttributes());
    }
}