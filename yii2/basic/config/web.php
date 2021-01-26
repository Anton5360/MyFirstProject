<?php

use app\components\LanguageComponent;
use yii\swiftmailer\Mailer;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'language'],
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@storage' => __DIR__ . '/../storage',
    ],
    'components' => [
        'authManager' => require __DIR__ . '/authManager.php',
        'i18n' => require __DIR__ . '/i18n.php',
        'request' => [
            'cookieValidationKey' => '2ddUaTPB40XNemn9gh1vtw2lu3k8cObQ',
        ],
        'cache' => [
            'class' => yii\caching\FileCache::class,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => Mailer::class,
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => '/shop/default/index',
                'logout' => '/site/logout',
                'login' => '/site/login',
                'registration' => '/site/registration',
            ],
        ],
        'language' => LanguageComponent::class,
    ],
    'modules' => [
        'access' => [
            'class' => \mdm\admin\Module::class,
        ],
        'shop' => [
            'class' => \app\modules\ShopModule::class,
        ],
    ],
    'as access' => [
        'class' => \mdm\admin\components\AccessControl::class,
        'allowActions' => [
            'site/*',
            'access/*',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        'allowedIPs' => ['*'],
    ];
}

return $config;
