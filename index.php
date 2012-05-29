<?php
require("/../kevin.tools");

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii-git/yii.php';
$config=dirname(__FILE__).'/protected/config/properties.php';//development.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();
