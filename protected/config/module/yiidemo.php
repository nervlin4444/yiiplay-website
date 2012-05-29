<?php
/**
 * enable yii blog module
 */
if(strpos($_SERVER['REQUEST_URI'],'blog')!==false){
	//	it should be title
	$props['name']='Yii Blog Demo';
	$props['defaultController']='post';
	/**
	 * import autoloading model and component classes 
	 */
	$props=$import($props,'application.modules.blog.components.*');
	$props=$import($props,'application.modules.blog.models.*');
	/**
	 * enable yii module
	 */
	$props=$module($props,'blog');
	/**
	 * register components
	 * preload will call CApplicationComponent.init()
	 */
	$props=$component($props,'user',	'',false,array(
			'allowAutoLogin'=>true,));

	$props=$component($props,'db',			'',false,array(
			'connectionString' => 'sqlite:protected/modules/blog/data/blog.db',
			'tablePrefix' => 'tbl_',
	));
	
	/**
	 * Yii URLs Manager
	 */
/*	
	$props=$component($props,'urlManager',	'',false,array(
			'urlFormat'=>'path',
			'rules'=>array(
        		'post/<id:\d+>/<title:.*?>'=>'post/view',
        		'posts/<tag:.*?>'=>'post/index',
        		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),));
*/
	/**
	 * parameters & configurations basic
	 */
	// pagination use by blog call
	$props=$params($props,'pagination',		array(
			// number of posts displayed per page
			'postsPerPage'=>10,
			// maximum number of comments that can be displayed in recent comments portlet
			'recentCommentCount'=>10,
			// maximum number of tags that can be displayed in tag cloud portlet
			'tagCloudCount'=>20,
			// whether post comments need to be approved before published
			'commentNeedApproval'=>true,
	));

}

/**
 * enable yii hangman module
 */
if(strpos($_SERVER['REQUEST_URI'],'hangman')!==false){
	//	it should be title
	$props['name']='Hangman Game';
	$props['defaultController']='game';
	/**
	 * import autoloading model and component classes
	 */
	$props=$import($props,'application.modules.hangman.components.*');
	$props=$import($props,'application.modules.hangman.models.*');
	
	/**
	 * enable yii module
	 */
	$props=$module($props,'hangman');
	/**
	 * Yii URLs Manager
	 */
/*	
	$props=$component($props,'urlManager',	'',false,array(
			'urlFormat'=>'path',
			'rules'=>array(
				'hangman/game/guess/<g:\w>'=>'hangman/game/guess',
	),));
*/	
}

/**
 * enable yii phonebook module
 */
if(strpos($_SERVER['REQUEST_URI'],'phonebook')!==false){
	//	it should be title
	$props['name']='Yii Framework: Phone Book Demo';
	/**
	 * import autoloading model and component classes
	 */
	$props=$import($props,'application.modules.phonebook.components.*');
	$props=$import($props,'application.modules.phonebook.models.*');
	
	/**
	 * enable yii module
	 */
	$props=$module($props,'phonebook');
	/**
	 * Yii database
	 */
	$props=$component($props,'db',			'',false,array(
			'connectionString' => 'sqlite:protected/data/phonebook.db',
	));
	
}