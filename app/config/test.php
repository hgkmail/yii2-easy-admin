<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test_db.php';
$redis = require __DIR__.'/redis.php';

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'zh-CN',
    'timezone' => 'Asia/Shanghai',
    'components' => [
        'db' => $db,
        'redis' => $redis,
        'cache' => [
            'class' => \yii\redis\Cache::class
        ],
        'session' => [
            'name' => 'yii2-easy-admin',
            'class' => \yii\redis\Session::class
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'user' => [
//            'identityClass' => 'app\models\StaticUser',
            'identityClass' => 'app\models\User',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],
        'mainMenuService' => [
            'class' => '\app\services\MainMenuService'
        ],
        'optionService' => [
            'class' => '\app\services\OptionService'
        ],
        'inmailService' => [
            'class' => '\app\services\InmailService'
        ],
        'monolog' => [
            'class' => '\Mero\Monolog\MonologComponent',
            'channels' => [
                'main' => [
                    'handler' => [
                        [
                            'type' => 'stream',
                            'path' => '@app/runtime/logs/main_' . date('Y-m-d') . '.log',
                            'level' => 'debug'
                        ]
                    ],
                    'processor' => [],
                ],
                'op' => [
                    'handler' => [
                        [
                            'type' => 'stream',
                            'path' => '@app/runtime/logs/op_' . date('Y-m-d') . '.log',
                            'level' => 'info'
                        ]
                    ],
                    'processor' => [],
                ],
            ],
        ],
    ],
    'params' => $params,
];
