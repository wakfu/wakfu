<?php
return [
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => "夸父",
    'preload' => ['log'],

    'import' => [
        'application.models.*',
        'application.models.form.*',
        'application.components.*',
        'application.components.filters.*',
        'ext.*',
        'ext.fraudmetrix.*',
    ],

    'modules' => [
        'gii' => [
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            'ipFilters' => ['127.0.0.1', '::1'],
        ],

        'admin' => [
            'class' => 'application.modules.admin.AdminModule'
        ]
    ],

    'components' => [
        'user' => [
            'allowAutoLogin' => true,
            'stateKeyPrefix' => 'wakfu',
            'guestName' => '游客',
        ],

        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => [
                ['index/index', 'pattern' => 'index'],
                ['index/register', 'pattern' => 'register'],
                ['index/forget', 'pattern' => 'forget'],
                ['index/captcha', 'pattern' => 'captcha'],
                ['index/dashboard', 'pattern' => 'dashboard'],
                ['index/account','pattern' => 'account'],
                ['index/billing', 'pattern' => 'billing'],
                ['index/error', 'pattern' => 'error'],
            ],
        ],

//        'fraudmetrix' => [
//            'class' => 'ext.fraudmetrix.Fraudmetrix',
//            'partnerCode' => 'kf_Qox',
//            'secretKey' => '0c09a4607edf4bc0b1f7ce83a2ecb85d'
//        ],
//
//        'queue'=>[
//            'class' => 'SaeQueue',
//            'name' => 'serialQueue',
//        ],
//
//        'email' => [
//            'class' => 'SaeEmail',
//            'account' => 'toruneko@sina.com',
//            'password' => '041025hehe'
//        ],
//
//        'concurrenceQueue'=>[
//            'class' => 'SaeQueue',
//            'name' => 'concurrence',
//        ],

        'db' => [
            'connectionString' => 'mysql:host=127.0.0.1;dbname=wakfu',
            'emulatePrepare' => true,
            'schemaCachingDuration' => 86400,
            'username' => 'root',
            'password' => 'toruneko',
            'charset' => 'utf8',
        ],

        'cache' => [
            'class' => 'CMemCache',
            'useMemcached' => true,
            'servers' => [
                [
                    'host' => '127.0.0.1',
                    'port' => 11211,
                    'weight' => 100,
                ],
            ]
        ],

        'thrift' => [
            'class' => 'ThriftClient',
            'service' => [
                // 服务名 => 服务所在URL
                //'wakfuservice' => 'http://proxy.toruneko.net:9356/wakfu',
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'index/error',
        ],

        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, info',
                ],
            ],
        ],
    ],

    'params' => [
        'upload' => dirname(realpath($_SERVER['SCRIPT_FILENAME'])) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR,
        'version' => 'V1.0',
        'secretKey' => '',
        //上下级权限检测
        'allowCheck' => [
            'auth' => [
                'assign' => [
                    ['role', 'role', 'post'],
                    ['operation', 'operation', 'post'],
                ],
                'assignGroup' => [
                    ['auth', 'group', 'get'],
                    ['user', 'user', 'get'],
                ],
                'assignRole' => [
                    ['auth', 'role', 'get'],
                    ['user', 'user', 'get']
                ],
            ],
            'user' => [
                'edit' => [
                    ['id', 'user', 'get'],
                    [['UserForm', 'id'], 'user', 'post'],
                ]
            ],
        ],
    ],
];
