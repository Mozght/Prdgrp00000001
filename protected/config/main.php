<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    	'name'=>'Pradagroup | Приемка',
        'language'=>'ru',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.extensions.CAdvancedArBehavior',
                'application.extensions.pdfCreator',
	),
        'controllerMap' => array(
		// ...
		'barcodegenerator' => array(
			'class' => 'ext.barcodegenerator.BarcodeGeneratorController',
		),
	),
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'prada123123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
                'clientScript'=>array(
                    'packages'=>array(
                        'jquery'=>array(
                            'baseUrl'=>'/js/',
                            'js'=>array('jquery-1.11.0.min.js'),
                        )
                    ),
                ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'class' => 'WebUser',
		),
                'authManager' => array(
                    // Будем использовать свой менеджер авторизации
                    'class' => 'PhpAuthManager',
                    // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
                    'defaultRoles' => array('guest'),
                ),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=pradagro_base',
			'emulatePrepare' => true,
			'username' => 'pradagro_root',
			'password' => 'caZExGe6zfoq',
			'charset' => 'utf8',
			'tablePrefix'=>'pr_',
                        //'enableProfiling'=>true,
			// показываем значения параметров
			'enableParamLogging' => true,
		),
	
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                                array(
                                    'class'=>'ext.db_profiler.DbProfileLogRoute',
                                    'ignoreAjaxInFireBug'=>false,
                                    'countLimit' => 1, // How many times the same query should be executed to be considered inefficient
                                    'slowQueryMin' => 0.00001, // Minimum time for the query to be slow
                                ),
                        ),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
        
);