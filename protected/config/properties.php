<?php
/**
 * By default, the module class is determined using the ucfirst($moduleID).'Module'.
 * And the class file is located under modules/$moduleID
 */
// function module($props, $path)
$import=create_function(
		'$props,$path',
		'$props["import"][]=$path;return $props;');

// function module($props, $name, $param=null, $cptOpt=null)
$module=create_function(
		'$props,$name,$nest=array(),$param=array()',
		'$base="application.modules.";
		$format=((stripos($name,"Module")!==false)?
		$name:strtolower($name)).".".ucfirst($name)."Module";
		if(!is_array($nest)){
		$base.=($nest.".modules.");
		$props[$name]["class"]=$base.$format;
		$props[$name]=array_merge_recursive($props[$name],$param);}
		else{
		if(!empty($nest["import"])){
		$props["import"]=array_merge_recursive($props["import"],$nest["import"]);
		unset($nest["import"]);}
		if(empty($props["modules"][$name]))$props["modules"][$name]=array();
		$props["modules"][$name]=array_merge_recursive($props["modules"][$name],$param);
		if(empty($props["modules"][$name]["modules"]))
		$props["modules"][$name]["modules"]=array();
		$props["modules"][$name]["modules"]=
		array_merge_recursive($props["modules"][$name]["modules"],$nest);}
		$props["import"][]=$base.$format;
		return $props;');

// xxx default loaded by yii
// system.caching.xxx
// application.components.yiiplay.xxx
// modules.components.xxx

// function component($props, $name, $clazz, $preload=false, $cptOpt=array())
$component=create_function(
		'$props,$name,$clazz="",$preload=false,$cptOpt=array()',
		'$props["components"][$name]=$cptOpt;
		if(!empty($clazz))$props["components"][$name]["class"]=$clazz;
		if($preload)$props["preload"][$name]=true;return $props;');
// $locate=(strpos($clazz,"."))?$clazz:
// ((strpos($clazz,"system")!==false)?"system.":"application.").$clazz;
// (strpos($cptFolder,"modules")!==false)?"application.".$cptFolder.".".$clazz:
// (($cptFolder=="components")?"application.":"system.").$cptFolder.".".$clazz;

// function module($props, $name, $opt)
$params=create_function(
		'$props,$name,$opt',
		'$props["params"][$name]=$opt;return $props;');

/**
 * This is the main Web application configuration. Any writable
 * CWebApplication properties can be configured here.
 * $this == CWebApplication
 *
 * uncomment the following to define a path alias
 * Yii::setPathOfAlias('local','path/to/local-folder');
 *
 */
//$props=array('import'=>array(),'modules'=>array(),'components'=>array());
$props=array();

/**
 * default pre create Yii instance setting, no need change
 */
$props['basePath']=	dirname(__FILE__).DIRECTORY_SEPARATOR.'..';
//	it should be title
$props['name']=		'Yii Playground';
//	pre set language
$props['language']=	($_SERVER['SystemRoot']=='H:\WINDOWS')?'en_us':'zh_tw';
$props['timezone']=	'Asia/Hong_Kong';

//	set index default load
//$props['defaultController']='Home';
//	set customer theme
//	$themes=array('classic','beach','trond','twentyten','wikiwp');
//	$themes=array('trond');
// $props['theme']=	$themes[array_rand($themes)];//'freshy2','wordpress';


/**
 * import autoloading model and component classes 
 */
//	basic component
$props=$import($props,'application.models.*');
$props=$import($props,'application.components.*');

//enable customer extends
//include_once(dirname(__FILE__)."/fork/import.php");

/**
 * Yii URLs
 */
//	enable URLs Manager
//include_once(dirname(__FILE__)."/fork/url.php");

/**
 * Yii database
 */
//	enable Yii database
//include_once(dirname(__FILE__)."/fork/db.php");

/**
 * preload default will call CApplicationComponent.init()
 */
//$props['preload']['log']=true;


/**
 * components Core
 * setup enable or config of CApplicationComponent
 */
//	use 'site/error' action to display errors//TODO izzit only blog
$props=$component($props,'errorHandler',false,false,array(
		'errorAction'=>'site/error',));

//	use log router//TODO izzit only blog
$props=$component($props,'log',		'system.logging.CLogRouter',true,array(
		'routes'=>array(array(
		'class'=>'CFileLogRoute',
		'levels'=>'error, warning',),
		// show log messages on web pages
// 		array(
// 		'class'=>'CWebLogRoute',
//		'showInFireBug' => false),
		)));


/**
 * parameters & configurations basic
 * application-level parameters that can be accessed
 * using Yii::app()->params['paramName']
 *
 * cant same name bcos this using CMap
 */
//configurations for everywhere
		// this is displayed in the header section
$props=$params($props,'title','lAm LaM aReA');
		// this is used in contact page
$props=$params($props,'adminEmail','nerv_lin@yahoo.com.hk');
		// this is used in error pages
$props=$params($props,'errorEmail','nerv_lin@yahoo.com.hk');
		// the copyright information displayed in the footer section
$props=$params($props,'copyrightInfo','Copyright &copy; 2001 - '.date('Y').
		' by Kevin linz.<br/>All Rights Reserved.');

//configurations for widget
//$props=$params($props,'mb_mainmenu',
//		include_once(dirname(__FILE__)."/fork_menu.php"));

/////End basic/////

/**
 * components customer
 */
//	language switcher
include_once(dirname(__FILE__)."/component/langSwitcher.php");

//	kohana image package (change image format)
include_once(dirname(__FILE__)."/component/kohanaImage.php");


/**
 * Yii Customer Module
 * set CModule._moduleConfig behaviors that should be attached to the module
 */
// enable yii demo module
include_once(dirname(__FILE__)."/module/yiidemo.php");

// enable yii play module
include_once(dirname(__FILE__)."/module/yiiplay.php");

// enable rbac module
include_once(dirname(__FILE__)."/module/rbac.php");
// zzz($props['import']);
/**
 * extension customer
 */
// configurations for highslide
//include_once(dirname(__FILE__)."/extension/highslide.php");

// configurations for piwik
include_once(dirname(__FILE__)."/extension/piwik.php");


// configurations for unknow
		// where default iss replace
// $props['params']['iis']='iis/';
		// where default css replace
// $props['params']['css']='css/';
		// where default js replace
// $props['params']['js']='js/';
		
//xxx($props);

return ($props);