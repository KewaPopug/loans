<?php

use yii\web\JsonParser;
use yii\web\Response;

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
        'response' => [
            'class' => Response::class,
            'format' => Response::FORMAT_JSON,
        ],
        'request' => [
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
            'cookieValidationKey' => $params['cookieValidationKey'],
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
