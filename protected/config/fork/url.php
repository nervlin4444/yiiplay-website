<?php
/**
 * Yii URLs Manager
 * 
 * RESTful Api
 * http://www.yiiframework.com/wiki/175/how-to-create-a-rest-api/
 * 
 * Setting up the URL Manager 
 * When using the API, we would like to have the following URL scheme:
 * View all posts: index.php/api/posts (HTTP method GET)
 * View a single posts: index.php/api/posts/123 (also GET )
 * Create a new post: index.php/api/posts (POST)
 * Update a post: index.php/api/posts/123 (PUT)
 * Delete a post: index.php/api/posts/123 (DELETE)
 * 
 * In order to parse these URL's, set up the URL manager in config/main.php like this: 
 * 
 * urlManager'=>array(
    'urlFormat'=>'path',
    'rules'=>array(
        'post/<id:\d+>/<title:.*?>'=>'post/view',
        'posts/<tag:.*?>'=>'post/index',
        // REST patterns
        array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
        array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
        array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
        array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
        array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),
        // Other controllers
        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    ),
	),
 *
 *
 */
$props=$component($props,'urlManager',			'',false,array(
		'urlSuffix'=>'',
		'urlFormat'=>'path',
		'caseSensitive'=>true,
		'showScriptName'=>false,
		'rules'=>array(
        // REST patterns
		array('api/list',	'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
        array('api/view',	'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
        array('api/update',	'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
        array('api/delete',	'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
        array('api/create',	'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),
        // Other controllers
        '<model:\w+>/<controller:\w+>/<action:\w+>'=>'<model>/<controller>/<action>',
		),));
