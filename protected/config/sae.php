<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>"夸父",
	'preload'=>array('log'),

	'import'=>array(
		'application.models.*',
        	'application.models.form.*',
		'application.components.*',
        	'application.components.filters.*',
        	'ext.*',
	),

	'modules'=>array(
	        'admin' => array(
	            'class' => 'application.modules.admin.AdminModule'
	        )
	),

	'components'=>array(
		'user'=>array(
			'allowAutoLogin'=>true,
			'guestName' => '游客',
		),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'urlSuffix' => '',
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
			'connectionMaster' => 'mysql:host='.SAE_MYSQL_HOST_M.';port='.SAE_MYSQL_PORT.';dbname='.SAE_MYSQL_DB,
			'connectionSlave' => 'mysql:host='.SAE_MYSQL_HOST_S.';port='.SAE_MYSQL_PORT.';dbname='.SAE_MYSQL_DB,
			'emulatePrepare' => true,
        		'schemaCachingDuration' => 86400,
			'username' => SAE_MYSQL_USER,
			'password' => SAE_MYSQL_PASS,
			'charset' => 'utf8',
		),

        'cache'=>array(
            'class' => 'SaeMemCache',
        ),

        'queue'=>array(
            'class' => 'SaeQueue',
            'name' => 'serialQueue',
        ),

        'email' => array(
            'class' => 'SaeEmail',
            'account' => '',
            'password' => ''
        ),

        'concurrenceQueue'=>array(
            'class' => 'SaeQueue',
            'name' => 'concurrence',
        ),

        'thrift'=> array(
            'class' => 'ThriftClient',
            'service' => array(
                // 服务名 => 服务所在URL
                'wakfuservice' => '',
            ),
        ),
		
		'errorHandler'=>array(
			'errorAction'=>'index/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'SaeLogRoute',
					'levels'=>'error, warning, info',
				),
			),
		),
	),

	'params'=>array(
		'upload' => 'upload',
        'version' => 'V1.0',
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
