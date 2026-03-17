<?php

use yii\rest\UrlRule;
use yii\web\JsonParser;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
            'cookieValidationKey' => 'iUW4uR0yMrihMIngNxU1h1gM6c-zPVWR',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                /** @see \app\controllers\RequestController::actionCreate() */
                'requests' => 'request/create',
                /** @see \app\controllers\ProcessorController::actionIndex() */
                'processor' => 'processor/process'
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];

return $config;
