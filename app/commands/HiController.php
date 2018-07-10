<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-26
 * Time: 上午12:14
 */

namespace app\commands;


use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\DomCrawler\Crawler;
use yii\console\Controller;

class HiController extends Controller
{
    public function actionGuzzle()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');
        echo $res->getStatusCode();
        // 200
        echo $res->getHeaderLine('content-type');
        // 'application/json; charset=utf8'
        echo $res->getBody();
        // '{"id": 1420053, "name": "guzzle", ...}'
    }

    public function actionGuzzleAsync()
    {
        $client = new Client();
        // Send an asynchronous request.
        $request = new Request('GET', 'http://httpbin.org');
        $promise = $client->sendAsync($request)->then(function ($response) {
            echo 'I completed! ' . $response->getBody();
        });
        $promise->wait();
    }

    public function actionGoutte()
    {
        $client = new \Goutte\Client();
        $crawler = $client->request('GET', 'https://www.cnbeta.com/');
        $crawler->filter('.cnbeta-home-hero-figures .item > a.link')->each(function ($node, $index) use($client) {
            /** @var $node Crawler */
//            echo $node->attr('href')."\n";
            $link = $node->link();
//            var_dump($link->getUri());
//            $detail = $client->click($link);
            $detail = $client->click($link);
//            echo $detail->getUri()."\n";
            $detail->filter('header.title > h1')->each(function ($n, $i){
                /** @var $n Crawler */
                echo $n->text()."\n";
            });
        });
    }

    public function actionWeibo()
    {
        $url = "https://weibo.cn/u/3230715380";   // weibo WAP
        $client = new \Goutte\Client();
        $crawler = $client->request('GET', $url);
//        echo $crawler->html();
        $crawler->filter('span.ctt')->each(function ($node, $index) use($client) {
            /** @var $node Crawler */
            echo $node->text()."\n";
        });
    }

    public function actionExhentai()
    {
        $client = new \Goutte\Client();
        $client->getCookieJar()->set(new Cookie('ipb_member_id', '1405999',
            null, '/', '.exhentai.org'));
        $client->getCookieJar()->set(new Cookie('ipb_pass_hash', 'a36fa3d9f5c19d8ad5308a0e400188c8',
            null, '/', '.exhentai.org'));
        $client->getCookieJar()->set(new Cookie('sl', 'dm_1',    // thumbnail mode
            null, '/', '.exhentai.org'));

        $crawler = $client->request('GET', 'https://exhentai.org/');
//        echo $crawler->html();
        $crawler->filter('div.id2')->each(function ($node, $index){
            /** @var $node Crawler */
            echo $node->filter('a')->first()->text()."\n";
        });
    }
}