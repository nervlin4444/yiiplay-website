<?php
/**
 * stop including
 */
if(stripos($_SERVER['REQUEST_URI'],'rbac/')===false)return;

//Submodules must implement in rbac.init()
//Yii::app()->setModules($this->modules)

//Quick Login Widget
// $this->widget('application.modules.user.components.LoginWidget');

/**
 * default pre create Yii instance setting, no need change
 */
//$props['localeDataPath']='protected/i18n/data/';

/**
 * import autoloading model and component classes
 */
//$props=$import($props,'application.modules.rbac.modules.user.UserModule');

/**
 * enable yii submodule
 */
$subms=array();
$subms=$module($subms,'user','rbac',array(
		// when installed say false
		'debug' => false,
		 
		// install db table used
		'userTable' => 				'rbac_user',
		'privacySettingTable' =>	'rbac_privacysetting',
		'translationTable' => 		'rbac_translation',
		'avaterTable' => 			'rbac_avater',
		'messageTable' => 			'rbac_message',
		'usergroupTable' => 		'rbac_user_group',
		'usergroupMessagesTable'=>	'rbac_user_group_message',
		'profileTable' => 			'rbac_profile',
		'profileCommentTable' => 	'rbac_profile_comment',
		'profileVisitTable' => 		'rbac_profile_visit',
		'profileFieldTable' => 		'rbac_profile_field',
		'roleTable' => 				'rbac_role',
		'userRoleTable' => 			'rbac_user_role',
		'membershipTable' => 		'rbac_membership',
		'paymentTable' =>			'rbac_payment',
		'friendshipTable' => 		'rbac_friendship',
		'permissionTable' => 		'rbac_permission',
		'actionTable' => 			'rbac_action',

		// language
// 		'language' => 'en',

		// Username Requirements
		'usernameRequirements'=> array(
				'minLen'=>3,
				'maxLen'=>30,
				'match' => '/^[A-Za-z0-9_]+$/u',
				'dontMatchMessage' => 'Incorrect symbol\'s. (A-z0-9)',),

		// Password Requirements see components/CPasswordValidator.php
		'passwordRequirements' => array(
				'minLen' => 8,
				'maxLen' => 32,
				'minLowerCase' => 1,
				'minUpperCase'=>0,
				'minDigits' => 1,
				'maxRepetition' => 3,),

		// let users be able to register to your Application without Registration
		'disableEmailActivation'=>false,

//  	'profileLayout' => '//layouts/main',
//  	'profileView' => '//profile/view',
		// 	'avatarScaleImage' => false,
		// 	'layout' => '//layouts/main',
		//  	'userLayout' => '/layouts/main',
		// 	'avatarPath' => 'images/avatar',
		// 	'registrationEmail' => 'kontakt@mein-service-check.de',
		// 	'loginType' => 3,
		// 	'registrationType' => 2,
		// 	'loginView' => '//user/login'
		
		));

$subms=$module($subms,'usergroup','rbac',array(
		// install db table used
		'usergroupTable' => 'rbac_user_group',
		'usergroupMessagesTable' => 'rbac_user_group_message',
));

$subms=$module($subms,'membership','rbac',array(
		// install db table used
		'membershipTable' => 'rbac_membership',
		'paymentTable' => 'rbac_payment',
));

$subms=$module($subms,'friendship','rbac',array(
		// install db table used
		'friendshipTable' => 'rbac_friendship',
));

$subms=$module($subms,'profile','rbac',array(
		// install db table used
		'privacySettingTable' => 'rbac_privacysetting',
		'profileFieldTable' => 'rbac_profile_field',
		'profileTable' => 'rbac_profile',
		'profileCommentTable' => 'rbac_profile_comment',
		'profileVisitTable' => 'rbac_profile_visit',
));

$subms=$module($subms,'role','rbac',array(
		// install db table used
		'roleTable' => 'rbac_role',
		'userRoleTable' => 'rbac_user_role',
		'actionTable' => 'rbac_action',
		'permissionTable' => 'rbac_permission',
));

$subms=$module($subms,'message','rbac',array(
		// install db table used
		'messageTable' => 'rbac_message',
));

$subms=$module($subms,'avatar','rbac',array(
		// install db table used
//		'messageTable' => 'rbac_avatar',
));

/**
 * enable yii module
 */
$props=$module($props,'rbac',$subms);
//zzz($props['modules']);
//zzz($props['import'],$props['modules']);
/**
 * register components
 * preload will call CApplicationComponent.init()
 */
$props=$component($props,'db',			'',false,array(
		'connectionString' => 'mysql:host=localhost;dbname=398765',
		'emulatePrepare' => true,
		'username' => 'root',
		'password' => '4444',
		'charset' => 'utf8',
		'tablePrefix' => 'rbac_',
));

//	set NO caching component
// $props=$component($props,'cache',	'system.caching.CDummyCache',false,array(
// 			'gCProbability'			=>100,
// 			'directoryLevel'		=>1,));

//	provides a file-based caching mechanism
$props=$component($props,'cache',	'system.caching.CFileCache',false,array(
		'gCProbability'			=>100,
		'directoryLevel'		=>1,));

//	provides a memcache servers caching mechanism
// $props=$component($props,'cache',	'system.caching.CMemCache',false,array(
// 			));


//	Please make sure that Yii uses the YumWebUser component instead of CWebUser
$props=$component($props,'user','application.modules.rbac.modules.user.components.YumWebUser',false,array(
		// enable cookie-based authentication
		'allowAutoLogin'=>true,
		// any module ask for login should goto
		'loginUrl' => array('//rbac/user/login'),
));

/**
 * Yii URLs Manager
 */
$props=$component($props,'urlManager',			'',false,array(
		'urlSuffix'=>'',
		'urlFormat'=>'path',
		'rules'=>array(
		// REST patterns
		array('//rbac/user/rest/list', 'pattern' => 'rest/<mode:\w+>', 'verb' => 'GET'),
		array('//rbac/user/rest/view', 'pattern' => 'rest/<mode:\w+>/<id:\d+>', 'verb' => 'GET'), 
		array('//rbac/user/rest/create', 'pattern'=>'rest/create/<mode:\w+>', 'verb'=>'POST'),
		array('//rbac/user/rest/update', 'pattern'=>'rest/update/<mode:\w+>/<id:\d+>', 'verb'=>'PUT'),
		),));

/**
 * parameters & configurations
 */
$props=$params($props,'database_format',array(
		'date'=>'yyyy-MM-dd',
		'time'=>'HH:mm:ss',
		'dateTimeFormat'=>'{1} {0}',));