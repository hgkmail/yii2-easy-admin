<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-14
 * Time: 下午12:03
 */

// test data for main menu
// backup
$staticItems = [
    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
    ['label' => 'Login', 'icon' => 'sign-in', 'url' => ['site/login']],
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
    ['label' => 'Users', 'icon' => 'user-circle', 'url' => ['/user/index']],
    ['label' => 'Roles', 'icon' => 'users', 'url' => ['/role/index']],
    ['label' => 'Menus', 'icon' => 'bars', 'url' => ['/menu/index']],
    ['label' => 'Feedback', 'icon' => 'comment', 'url' => ['/feedback/index']],
];