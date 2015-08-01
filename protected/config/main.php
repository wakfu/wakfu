<?php
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => "夸父",
	'preload' => array('log'),

	'import'=>array(
		'application.models.*',
        'application.models.form.*',
		'application.components.*',
        'application.components.filters.*',
        'ext.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
			
		'admin' => array(
			'class' => 'application.modules.admin.AdminModule'
		)
	),

	'components'=>array(
		'user'=>array(
			'allowAutoLogin' => true,
            'stateKeyPrefix' => 'wakfu',
			'guestName' => '游客',
		),

		'urlManager'=>array(
			'urlFormat'=>'path',
		    'showScriptName'=>false,
			'rules'=>array(
                array('index/index','pattern' => 'index'),
                array('index/register','pattern' => 'register'),
                array('index/forget','pattern' => 'forget'),
                array('index/captcha','pattern' => 'captcha'),
				array('index/dashboard','pattern' => 'dashboard'),
                array('index/error','pattern' => 'error'),
			),
		),

		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=wakfu',
			'emulatePrepare' => true,
            'schemaCachingDuration' => 86400,
			'username' => 'root',
			'password' => 'toruneko',
			'charset' => 'utf8',
		),

        'cache'=>array(
            'class' => 'CMemCache',
            'useMemcached' => true,
            'servers' => array(
                array(
                    'host' => '127.0.0.1',
                    'port' => 11211,
                    'weight' => 100,
                ),
            )
        ),

        'thrift' => array(
            'class' => 'ThriftClient',
            'service' => array(
                //服务名 => 服务所在URL
                //'wakfuservice' => 'http://proxy.toruneko.net:9356/wakfu',
            ),
        ),
		
		'errorHandler'=>array(
			'errorAction'=>'index/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info',
				),
			),
		),
	),

	'params'=>array(
        'upload' => dirname(realpath($_SERVER['SCRIPT_FILENAME'])).DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR,
        'version' => 'V1.0',
        'secretKey' => '',
        //上下级权限检测
        'allowCheck' => array(
            'auth' => array(
                'assign' => array(
                    array('role','role','post'),
                    array('operation','operation','post'),
                ),
                'assignGroup' => array(
                    array('auth','group','get'),
                    array('user','user','get'),
                ),
                'assignRole' => array(
                    array('auth','role','get'),
                    array('user','user','get')
                ),
            ),
            'user' => array(
                'edit' => array(
                    array('id','user','get'),
                    array(array('UserForm','id'),'user','post'),
                )
            ),
        ),
    ),
);