<?php
/**
 * Yii database
 * 
 * Our first step is to add custom functionality to the active record to 
 * force all child classes to use our method of table prefixing.
 * 
 * To do this, we use the following logic:
 * Add an application paramater where we are storing the prefix
 * Create a new ActiveRecord class that all our Models will inherit
 * Since the function tableName is used to find the table associated 
 * with the model we are going to force all child classes to 
 * use our customized tableName method
 * Create a new method for the child classes to implement instead of tableName()
 * 
 * All this can be achieved in our new ActiveRecord class.
 * First add the new config item to config/main.php
 * 'params' => array(
 * 		'custom_db'=>array(
 * 		'connectionString' => 'mysql:host=localhost;dbname=398765',
 * 		'emulatePrepare' => true,
 * 		'username' => '398765',
 * 		'password' => 'nooblin',
 * 		'charset' => 'utf8',
 * 		'tablePrefix' => 'app_',
 * 		)),
 * 
 * Next, replace Yii->app()->getDB() class for our customized functionality.
 * 
 * foreach(Yii::app()->params['custom_db'] as $k=>$v){
 * $db->$k=$v;}
 * 
 */
//default CDBConnection must be stay bcos it is core cpt
$props=$component($props,'db',		'',false,array(
		// comment if activate the connection from other CApplicationComponent
		'autoConnect'=>false,
		// set connectionString from dbManager
		'connectionString' => '',
		'emulatePrepare' => true,
		'username' => '',
		'password' => '',
		'charset' => 'utf8',
		// prefix to db table
		'tablePrefix' => '',
		// blog?
		'enableParamLogging' => true
));

//second
