<?php
/**
 * 	autoloading model and component classes
 */
//	modularize component
$props=$import($props,'application.components.modularize.*');
$props=$import($props,'application.components.modularize.mvc.*');

//	yii api
$props=$import($props,'application.components.api.*');

//	yii utility
$props=$import($props,'application.components.util.*');

//linz package driver
// $props=$import($props,'application.components.linz.*');

//geshi Generic Syntax Highlighter
// $props=$import($props,'application.components.geshi.*');

//currency conversions based on the daily currency rates
// $props=$import($props,'application.components.currency.*');

//array data provider for Ecurrency
// $props=$import($props,'application.extensions.arraydataprovider.*');

//captcha Extension
// $props=$import($props,'application.extensions.captchaExtended.*');



