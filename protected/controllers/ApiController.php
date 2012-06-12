<?php
class ApiController extends Controller
{
	// Members
	/**
	 * Key which has to be in HTTP USERNAME and PASSWORD headers
	 */
	Const APPLICATION_ID = 'ASCCPE';

	/**
	 * Default response format
	 * either 'json' or 'xml'
	 */
	private $format = 'json';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array();
	}

	// Actions
	
	/**
	 * Get all Models List Action
	 */
	public function actionList()
	{
		// Get the respective model instance
		switch($_GET['model'])
		{
			case 'posts':
				$models = Post::model()->findAll();
				break;
			default:
				// Model not implemented error
				$this->_sendResponse(501, sprintf(
				'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
				$_GET['model']) );
				Yii::app()->end();
		}
		// Did we get some results?
		if(empty($models)) {
			// No
			$this->_sendResponse(200,
					sprintf('No items where found for model <b>%s</b>', $_GET['model']) );
		} else {
			// Prepare response
			$rows = array();
			foreach($models as $model)
				$rows[] = $model->attributes;
			// Send the response
			$this->_sendResponse(200, CJSON::encode($rows));
		}		
	}
	
	/**
	 * Get a Single Model Action
	 */
	public function actionView()
	{
		// Check if id was submitted via GET
		if(!isset($_GET['id']))
			$this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing' );
		
		switch($_GET['model'])
		{
			// Find respective model
			case 'posts':
				$model = Post::model()->findByPk($_GET['id']);
				break;
			default:
				$this->_sendResponse(501, sprintf(
				'Mode <b>view</b> is not implemented for model <b>%s</b>',
				$_GET['model']) );
				Yii::app()->end();
		}
		// Did we find the requested model? If not, raise an error
		if(is_null($model))
			$this->_sendResponse(404, 'No Item found with id '.$_GET['id']);
		else
			$this->_sendResponse(200, CJSON::encode($model));
	}

	/**
	 * Create a new Model Action
	 */
	public function actionCreate()
	{
		switch($_GET['model'])
		{
			// Get an instance of the respective model
			case 'posts':
				$model = new Post;
				break;
			default:
				$this->_sendResponse(501,
				sprintf('Mode <b>create</b> is not implemented for model <b>%s</b>',
				$_GET['model']) );
				Yii::app()->end();
		}
		// Try to assign POST values to attributes
		foreach($_POST as $var=>$value) {
			// Does the model have this attribute? If not raise an error
			if($model->hasAttribute($var))
				$model->$var = $value;
			else
				$this->_sendResponse(500,
						sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var,
								$_GET['model']) );
		}
		// Try to save the model
		if($model->save())
			$this->_sendResponse(200, CJSON::encode($model));
		else {
			// Errors occurred
			$msg = "<h1>Error</h1>";
			$msg .= sprintf("Couldn't create model <b>%s</b>", $_GET['model']);
			$msg .= "<ul>";
			foreach($model->errors as $attribute=>$attr_errors) {
				$msg .= "<li>Attribute: $attribute</li>";
				$msg .= "<ul>";
				foreach($attr_errors as $attr_error)
					$msg .= "<li>$attr_error</li>";
				$msg .= "</ul>";
			}
			$msg .= "</ul>";
			$this->_sendResponse(500, $msg );
		}
	}

	/**
	 * Update a Model Action
	 */
	public function actionUpdate()
	{
		// Parse the PUT parameters. This didn't work: parse_str(file_get_contents('php://input'), $put_vars);
		$json = file_get_contents('php://input'); //$GLOBALS['HTTP_RAW_POST_DATA'] is not preferred: http://www.php.net/manual/en/ini.core.php#ini.always-populate-raw-post-data
		$put_vars = CJSON::decode($json,true);  //true means use associative array
		
		switch($_GET['model'])
		{
			// Find respective model
			case 'posts':
				$model = Post::model()->findByPk($_GET['id']);
				break;
			default:
				$this->_sendResponse(501,
				sprintf( 'Error: Mode <b>update</b> is not implemented for model <b>%s</b>',
				$_GET['model']) );
				Yii::app()->end();
		}
		// Did we find the requested model? If not, raise an error
		if($model === null)
			$this->_sendResponse(400,
					sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",
							$_GET['model'], $_GET['id']) );
		
		// Try to assign PUT parameters to attributes
		foreach($put_vars as $var=>$value) {
			// Does model have this attribute? If not, raise an error
			if($model->hasAttribute($var))
				$model->$var = $value;
			else {
				$this->_sendResponse(500,
						sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>',
								$var, $_GET['model']) );
			}
		}
		// Try to save the model
		if($model->save())
			$this->_sendResponse(200, CJSON::encode($model));
		else
			// prepare the error $msg
			// see actionCreate
			// ...
			$this->_sendResponse(500, $msg );
	}
	
	/**
	 * Delete a Model Action
	 */
	public function actionDelete()
	{
		switch($_GET['model'])
		{
			// Load the respective model
			case 'posts':
				$model = Post::model()->findByPk($_GET['id']);
				break;
			default:
				$this->_sendResponse(501,
				sprintf('Error: Mode <b>delete</b> is not implemented for model <b>%s</b>',
				$_GET['model']) );
				Yii::app()->end();
		}
		// Was a model found? If not, raise an error
		if($model === null)
			$this->_sendResponse(400,
					sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",
							$_GET['model'], $_GET['id']) );
		
		// Delete the model
		$num = $model->delete();
		if($num>0)
			$this->_sendResponse(200, $num);    //this is the only way to work with backbone
		else
			$this->_sendResponse(500,
					sprintf("Error: Couldn't delete model <b>%s</b> with ID <b>%s</b>.",
							$_GET['model'], $_GET['id']) );		
	}
	
	/**
	 * Please keep in mind to check your model beforeSave and afterSave methods 
	 * if any code eventually uses a logged-in user's id like the blog Post model:
	 */
	protected function beforeSave()
	{
		// author_id may have been posted via API POST
		if(is_null($this->author_id) or $this->author_id=='')
		$this->author_id=Yii::app()->user->id;
	}
	
	/**
	 * Sending the Response 
	 * 
	 * How are the API responses actually sent? Right, we need to implement the _sendResponse method.
	 * 
	 * This code is borrowed from http://www.gen-x-design.com/archives/create-a-rest-api-with-php.
	 * 
	 * Finally, in the function _sendResponse, I added the lines:
	 * 
	 * header("Access-Control-Allow-Origin: *");
	 * 
	 * header("Access-Control-Allow-Headers: Authorization");
	 * 
	 */
	private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
	{
		// set the status
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
		header($status_header);
		// and the content type
		header('Content-type: ' . $content_type);
	
		// pages with body are easy
		if($body != '')
		{
			// send the body
			echo $body;
		}
		// we need to create the body if none is passed
		else
		{
			// create some body messages
			$message = '';
	
			// this is purely optional, but makes the pages a little nicer to read
			// for your users.  Since you won't likely send a lot of different status codes,
			// this also shouldn't be too ponderous to maintain
			switch($status)
			{
				case 401:
					$message = 'You must be authorized to view this page.';
					break;
				case 404:
					$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
					break;
				case 500:
					$message = 'The server encountered an error processing your request.';
					break;
				case 501:
					$message = 'The requested method is not implemented.';
					break;
			}
	
			// servers don't always have a signature turned on
			// (this is an apache directive "ServerSignature On")
			$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
	
			// this should be templated in a real-world solution
			$body = '
			<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
			</head>
			<body>
			<h1>' . $this->_getStatusCodeMessage($status) . '</h1>
			<p>' . $message . '</p>
			<hr />
			<address>' . $signature . '</address>
			</body>
			</html>';
	
			echo $body;
		}
		Yii::app()->end();
	}	
	
	/**
	 * Getting the Status Codes 
	 * 
	 * Also, we need to implement the _getStatusCodeMessage method. This is pretty straight forward:
	 */
	private function _getStatusCodeMessage($status)
	{
		// these could be stored in a .ini file and loaded
		// via parse_ini_file()... however, this will suffice
		// for an example
		$codes = Array(
            100 => 'Continue',  
            101 => 'Switching Protocols',  
            200 => 'OK',  
            201 => 'Created',  
            202 => 'Accepted',  
            203 => 'Non-Authoritative Information',  
            204 => 'No Content',  
            205 => 'Reset Content',  
            206 => 'Partial Content',  
            300 => 'Multiple Choices',  
            301 => 'Moved Permanently',  
            302 => 'Found',  
            303 => 'See Other',  
            304 => 'Not Modified',  
            305 => 'Use Proxy',  
            306 => '(Unused)',  
            307 => 'Temporary Redirect',  
            400 => 'Bad Request',  
            401 => 'Unauthorized',  
            402 => 'Payment Required',  
            403 => 'Forbidden',  
            404 => 'Not Found',  
            405 => 'Method Not Allowed',  
            406 => 'Not Acceptable',  
            407 => 'Proxy Authentication Required',  
            408 => 'Request Timeout',  
            409 => 'Conflict',  
            410 => 'Gone',  
            411 => 'Length Required',  
            412 => 'Precondition Failed',  
            413 => 'Request Entity Too Large',  
            414 => 'Request-URI Too Long',  
            415 => 'Unsupported Media Type',  
            416 => 'Requested Range Not Satisfiable',  
            417 => 'Expectation Failed',  
            500 => 'Internal Server Error',  
            501 => 'Not Implemented',  
            502 => 'Bad Gateway',  
            503 => 'Service Unavailable',  
            504 => 'Gateway Timeout',  
            505 => 'HTTP Version Not Supported'  
		);
		return (isset($codes[$status])) ? $codes[$status] : '';
	}
	
	/**
	 * Authentication 
	 * 
	 * If we want to have the API user authorize himself, we could write something like this:
	 * 
	 * at the beginning of each method.
	 * 
	 * The API user then needs to set the X_USERNAME and X_PASSWORD headers in his request.
	 */
	private function _checkAuth()
	{
		// Check if we have the USERNAME and PASSWORD HTTP headers set?
		if(!(isset($_SERVER['HTTP_X_USERNAME']) and isset($_SERVER['HTTP_X_PASSWORD']))) {
			// Error: Unauthorized
			$this->_sendResponse(401);
		}
		$username = $_SERVER['HTTP_X_USERNAME'];
		$password = $_SERVER['HTTP_X_PASSWORD'];
		// Find the user
		$user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
		if($user===null) {
			// Error: Unauthorized
			$this->_sendResponse(401, 'Error: User Name is invalid');
		} else if(!$user->validatePassword($password)) {
			// Error: Unauthorized
			$this->_sendResponse(401, 'Error: User Password is invalid');
		}
	}
	/**
	 * Going cross-domain with CORS
	 * 
	 * To make this REST API cross-domain with CORS, there are other things we need to do. In this example I am adding support for cross-domain requests with Basic Authentication headers and json content.
	 * 
	 * Cross-domain requests may need a preflight request if your request uses other verbs, headers or json support (learn more about it here).
	 * 
	 * A preflight request is basically an OPTIONS request to ask for permission to use cross-domain features.
	 * 
	 * So we have add the proper verb in the url manager rules (config/main.php):
	 * 
	 * // REST CORS pattern
	 * 
	 * array('api/preflight', 'pattern'=>'api/*', 'verb'=>'OPTIONS'),
	 * 
	 * Then, in our ApiController, we added the corresponding action:
	 * 
	 */
	public function actionPreflight() {
		$content_type = 'application/json';
		$status = 200;
	
		// set the status
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
		header($status_header);
	
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		header("Access-Control-Allow-Headers: Authorization");
		header('Content-type: ' . $content_type);
	}
	
/*
 * I am accessing the REST API from a JS mobile app like this:

$.ajax({
    url: 'http://myserver.com/index.php/api/user/1',
    type: 'GET',
    dataType: 'json',
    success: function(data, textStatus, jqXHR) { 
        /* do stuff with data*/
/*    },
    beforeSend: function (xhr) { 
        xhr.setRequestHeader ("Authorization", "Basic cGVkcm9za???????????????206MTIz"); 
    },
    complete: function(jqXHR, textStatus){
        /* do other stuff*/
/*        },
    });


 * 
 */	
	
	
}

class RestRequest
{
	private $request_vars;
	private $data;
	private $http_accept;
	private $method;

	public function __construct()
	{
		$this->request_vars      = array();
		$this->data              = '';
		$this->http_accept       = (strpos($_SERVER['HTTP_ACCEPT'], 'json')) ? 'json' : 'xml';
		$this->method            = 'get';
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function setMethod($method)
	{
		$this->method = $method;
	}

	public function setRequestVars($request_vars)
	{
		$this->request_vars = $request_vars;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function getHttpAccept()
	{
		return $this->http_accept;
	}

	public function getRequestVars()
	{
		return $this->request_vars;
	}
	
	/**
	 * There are a few ways we could go about doing this, 
	 * but let’s just assume that we’ll always get a key/value pair in our request: 
	 * ‘data’ => actual data. Let’s also assume that the actual data will be JSON. 
	 * As stated in my previous explanation of REST, 
	 * you could look at the content-type of the request and deal with either JSON or XML, 
	 * but let’s keep it simple for now. 
	 * So, our process request function will end up looking something like this:
	 */
	public static function processRequest()
	{
		// get our verb
		$request_method = strtolower($_SERVER['REQUEST_METHOD']);
		$return_obj     = new RestRequest();
		// we'll store our data here
		$data           = array();
	
		switch ($request_method)
		{
			// gets are easy...
			case 'get':
				$data = $_GET;
				break;
				// so are posts
			case 'post':
				$data = $_POST;
				break;
				// here's the tricky bit...
			case 'put':
				// basically, we read a string from PHP's special input location,
				// and then parse it out into an array via parse_str... per the PHP docs:
				// Parses str  as if it were the query string passed via a URL and sets
				// variables in the current scope.
				parse_str(file_get_contents('php://input'), $put_vars);
				$data = $put_vars;
				break;
		}
	
		// store the method
		$return_obj->setMethod($request_method);
	
		// set the raw data, so we can access it if needed (there may be
		// other pieces to your requests)
		$return_obj->setRequestVars($data);
	
		if(isset($data['data']))
		{
			// translate the JSON to an Object for use however you want
			$return_obj->setData(json_decode($data['data']));
		}
		return $return_obj;
		
		
//////////////////		
		$data = RestUtils::processRequest();
		
		switch($data->getMethod)
		{
			case 'get':
				// retrieve a list of users
				break;
			case 'post':
				$user = new User();
				$user->setFirstName($data->getData()->first_name);  // just for example, this should be done cleaner
				// and so on...
				$user->save();
				break;
				// etc, etc, etc...
		}		
		
		
		
	}

	
	public static function sendResponse($status = 200, $body = '', $content_type = 'text/html')
	{
		$status_header = 'HTTP/1.1 ' . $status . ' ' . RestUtils::getStatusCodeMessage($status);
		// set the status
		header($status_header);
		// set the content type
		header('Content-type: ' . $content_type);
	
		// pages with body are easy
		if($body != '')
		{
			// send the body
			echo $body;
			exit;
		}
		// we need to create the body if none is passed
		else
		{
			// create some body messages
			$message = '';
	
			// this is purely optional, but makes the pages a little nicer to read
			// for your users.  Since you won't likely send a lot of different status codes,
			// this also shouldn't be too ponderous to maintain
			switch($status)
			{
				case 401:
					$message = 'You must be authorized to view this page.';
					break;
				case 404:
					$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
					break;
				case 500:
					$message = 'The server encountered an error processing your request.';
					break;
				case 501:
					$message = 'The requested method is not implemented.';
					break;
			}
	
			// servers don't always have a signature turned on (this is an apache directive "ServerSignature On")
			$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
	
			// this should be templatized in a real-world solution
			$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<title>' . $status . ' ' . RestUtils::getStatusCodeMessage($status) . '</title>
			</head>
			<body>
			<h1>' . RestUtils::getStatusCodeMessage($status) . '</h1>
			<p>' . $message . '</p>
			<hr />
			<address>' . $signature . '</address>
			</body>
			</html>';
	
			echo $body;
			exit;
		}
		
////////////////////////

		switch($data->getMethod)
		{
			// this is a request for all users, not one in particular
			case 'get':
				$user_list = getUserList(); // assume this returns an array
		
				if($data->getHttpAccept == 'json')
				{
					RestUtils::sendResponse(200, json_encode($user_list), 'application/json');
				}
				else if ($data->getHttpAccept == 'xml')
				{
					// using the XML_SERIALIZER Pear Package
					$options = array
					(
							'indent' => '     ',
							'addDecl' => false,
							'rootName' => $fc->getAction(),
							XML_SERIALIZER_OPTION_RETURN_RESULT => true
					);
					$serializer = new XML_Serializer($options);
		
					RestUtils::sendResponse(200, $serializer->serialize($user_list), 'application/xml');
				}
		
				break;
				// new user create
			case 'post':
				$user = new User();
				$user->setFirstName($data->getData()->first_name);  // just for example, this should be done cleaner
				// and so on...
				$user->save();
		
				// just send the new ID as the body
				RestUtils::sendResponse(201, $user->getId());
				break;
		}
		
/////////////////////////

		if(emptyempty($_SERVER['PHP_AUTH_DIGEST']))
		{
			header('HTTP/1.1 401 Unauthorized');
			header('WWW-Authenticate: Digest realm="' . AUTH_REALM . '",qop="auth",nonce="' . uniqid() . '",opaque="' . md5(AUTH_REALM) . '"');
		
			// show the error if they hit cancel
			die(RestControllerLib::error(401, true));
		}
		
		// now, analayze the PHP_AUTH_DIGEST var
		if(!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) || $auth_username != $data['username'])
		{
			// show the error due to bad auth
			die(RestUtils::sendResponse(401));
		}
		
		// so far, everything's good, let's now check the response a bit more...
		$A1 = md5($data['username'] . ':' . AUTH_REALM . ':' . $auth_pass);
		$A2 = md5($_SERVER['REQUEST_METHOD'] . ':' . $data['uri']);
		$valid_response = md5($A1 . ':' . $data['nonce'] . ':' . $data['nc'] . ':' . $data['cnonce'] . ':' . $data['qop'] . ':' . $A2);
		
		// last check..
		if($data['response'] != $valid_response)
		{
			die(RestUtils::sendResponse(401));
		}		
		
		
		
		
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}