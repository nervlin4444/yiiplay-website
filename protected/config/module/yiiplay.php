<?php
/**
 * stop including
 */
//if(stripos($_SERVER['REQUEST_URI'],'Module/')===false)return;

/**
 * default pre create Yii instance setting, no need change
 */
$props['localeDataPath']='protected/i18n/data/';

/**
 * import autoloading model and component classes 
 */
$props=$import($props,'application.components.yiiplay.*');

/**
 * enable yii module
 */
$props=$module($props,'AjaxModule');
$props=$module($props,'InternationalizationModule');
$props=$module($props,'UiModule');

/**
 * register components
 * preload will call CApplicationComponent.init()
 */
$props=$component($props,'dbManager',	'application.components.yiiplay.DbManager',true);
$props=$component($props,'lc',			'application.components.yiiplay.LocaleManager',true);
$props=$component($props,'sc',			'application.components.yiiplay.SrcCollect',false);
$props=$component($props,'uiSettings',	'application.components.yiiplay.UiSettings',true);

$props=$component($props,'db',			'',false,array(
		'connectionString' => 'mysql:host=localhost;dbname=yiiplay',
		'emulatePrepare' => true,
		'username' => 'root',
		'password' => '4444',
		'charset' => 'utf8',
		'tablePrefix' => 'tbl_',
));

/**
 * parameters & configurations
 */ 
$props=$params($props,'factory_db',		'protected/data/factory.db');
$props=$params($props,'user_db',		'protected/data/user.db');
$props=$params($props,'database_format',array(
		'date'=>'yyyy-MM-dd',
		'time'=>'HH:mm:ss',
		'dateTimeFormat'=>'{1} {0}',));
