<?php
return [
    'rootDir' => __DIR__ . "/../",
    'servicesDir' => __DIR__ . "/../services/",
    'viewsDir' => __DIR__ . "/../views/",
    'vendorDir' => __DIR__ . "/../vendor/",
    'defaultController' => 'product',
    'controllerNamespace' => 'app\controllers\\',
    'components' => [
        'db' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => 'root',
            'database' => 'shop',
            'charset' => 'utf8',
        ],
        'request' => [
            'class' => \app\services\Request::class,
        ],
        'session' => [
            'class' => \app\services\Session::class
        ],
        'renderer' => [
            'class' => \app\services\renderers\TemplateRenderer::class
        ],
        'hash' => [
            'class' => \app\services\Hash::class,
            'salt' => 'd5f8',
        ],
    ]
];