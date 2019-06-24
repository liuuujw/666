<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'GiYXs4F97RfgLg9NqrQSToWG1nytxGQp',
        ],
        'msdb' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlsrv:Server=D2TSDVAOPEJFSKW;Database=Hnlg_work',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=hnlg_work',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
        'dbol' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=106.13.125.248;dbname=book_center',
            'username' => 'root',
            'password' => ',./123asd',
            'charset' => 'utf8',
        ]
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
