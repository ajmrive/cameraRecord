<?php

$params = require(__DIR__ . '/params.php');

$config = [
  'id' => 'basic',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'modules' => [
    'user' => [
      'class' => 'amnah\yii2\user\Module',
    // set custom module properties here ...
    ],
  ],
  'components' => [
    // NOTE: in the yii2-advanced-app, the user component should be updated in
    // 'frontend/config/main.php' and/or 'backend/config/main.php' (OR you can add it
    // to 'common/config' if you remove it from frontend/backend)
    'user' => [
      'class' => 'amnah\yii2\user\components\User',
    ],
    'mailer' => [
      'class' => 'yii\swiftmailer\Mailer',
      'useFileTransport' => true,
      'messageConfig' => [
        'from' => ['antonio@amedinarproject.com' => 'Admin'], // this is needed for sending emails
        'charset' => 'UTF-8',
      ]
    ],
    'request' => [
      // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
      'cookieValidationKey' => 'nQWKqLnhc06EOuOyFdWMu5gDhzT6ACD7',
    ],
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
//    'user' => [
//      'identityClass' => 'app\models\User',
//      'enableAutoLogin' => true,
//    ],
    'errorHandler' => [
      'errorAction' => 'site/error',
    ],
    'mailer' => [
      'class' => 'yii\swiftmailer\Mailer',
      // send all mails to a file by default. You have to set
      // 'useFileTransport' to false and configure a transport
      // for the mailer to send real emails.
      'useFileTransport' => true,
    ],
    'log' => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'levels' => ['error', 'warning'],
        ],
      ],
    ],
    'urlManager' => [
      'class' => 'yii\web\UrlManager',
      // Disable index.php
      'showScriptName' => false,
      // Disable r= routes
      'enablePrettyUrl' => true,
      'rules' => array(
        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
      ),
    ],
    'db' => require(__DIR__ . '/db.php'),
  ],
  'params' => $params,
];

if (YII_ENV_DEV) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'debug';
  $config['modules']['debug'] = 'yii\debug\Module';

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
