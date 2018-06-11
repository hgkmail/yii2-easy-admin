<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-5-31
 * Time: 下午6:34
 */

namespace app\services;


use Yii;
use yii\base\Component;

class MainMenuService extends Component
{
    private $staticItems = [];

    public function init()
    {
        parent::init();

        $this->staticItems = [
            ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
            ['label' => 'Login', 'icon' => 'sign-in', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
            [
                'label' => 'Some tools',
                'icon' => 'wrench',
                'url' => '#',
                'items' => [
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    [
                        'label' => 'Level One',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                            [
                                'label' => 'Level Two',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                    ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            ['label' => 'Users', 'icon' => 'users', 'url' => '/user/index', 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Menus', 'icon' => 'bars', 'url' => '/menu/index', 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Feedback', 'icon' => 'comment', 'url' => '/feedback/index', 'visible' => !Yii::$app->user->isGuest],
        ];
    }

    /**
     * @return array
     */
    public function getStaticItems()
    {
        return $this->staticItems;
    }
}