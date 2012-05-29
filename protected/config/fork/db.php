<?php
/**
 * Yii database
 */
//default
		// comment CDBConnection if not default connection
$props=$component($props,'db',	'CDBConnection',false,array(
		// comment if activate the connection from other CApplicationComponent
// 		'autoConnect'=>false,
		// set connectionString from dbManager
		'connectionString' => 'mysql:host=localhost;dbname=yiiplay',
		'emulatePrepare' => true,
		'username' => 'root',
		'password' => '4444',
		'charset' => 'utf8',
		// prefix to db table
		'tablePrefix' => 'tbl_',
		// blog?
		'enableParamLogging' => true
));
//'schemaCachingDuration' => '3600',
