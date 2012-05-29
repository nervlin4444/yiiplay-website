<?php
/**
 * This is the config file to be used by developers (not the production/demo server).
 * Extends the main.php config file.
 * See http://www.yiiframework.com/doc/cookbook/32/
 */
$props=$module($props,'gii',array(
		'class'=>'system.gii.GiiModule',
		'password'=>'yiirocks',
		'ipFilters'=>array('127.0.0.1'),
		// 'newFileMode'=>0666,
		// 'newDirMode'=>0777,
));
