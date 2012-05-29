<?php
/**
 * This is the base config file.  Other config files may extend this.  See development.php
 */


// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return ((array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Yii Playground',

	// preloading 'log' component
	'preload'=>array('log', 'dbManager', 'uiSettings', 'lc'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
//		'application.modules.rbac.modules.user.UserModule.*',
	),

	// application components
	'components'=>array(
		'cache'=>array(
		// set NO caching component
			'class'					=>'system.caching.CDummyCache',
		// provides a file-based caching mechanism
// 			'class'					=>'system.caching.CFileCache',
// 			'gCProbability'			=>100,
// 			'directoryLevel'		=>1,
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			// Please make sure that Yii uses the YumWebUser component instead of CWebUser
//			'class' => 'application.modules.user.components.YumWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			// any module ask for login should goto
			'loginUrl' => array('//user/login'),
		),
		'uiSettings'=>array(
			'class'=>'UiSettings',
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=yiiplay',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '4444',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',//prefix to db table
//customer
			'enableParamLogging' => true

// 			'autoConnect'=>false, // we will activate the connection from dbManager
// 			'connectionString' => '', // we set connectionString from dbManager
// 			'tablePrefix'=>'tbl_',
		),
		'sc'=>array(
			'class' => 'application.components.SrcCollect',
		),
		'dbManager'=>array(
			'class' => 'application.components.DbManager',
		),
		'lc'=>array(
			'class' => 'application.components.LocaleManager',
		),
		// uncomment the following to use a MySQL database
		/*
		'db_mysql'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
	
	'modules' => array(
		'AjaxModule',
		'UiModule',
		'InternationalizationModule',
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'factory_db'=>'protected/data/factory.db',
		'user_db'=>'protected/data/user.db',
		'database_format'=>array(
			'date'=>'yyyy-MM-dd',
			'time'=>'HH:mm:ss',
			'dateTimeFormat'=>'{1} {0}',
		),
	),
)));
