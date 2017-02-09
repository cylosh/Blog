<?php

/**
 * main: Handles routing & control operations for the application
 *
 * @author : Cylosh
 * @link : https://www.cylo.ro
 * @copyright : https://opensource.org/licenses/MIT

 * @version 1.0: 23 January 2017
 * 		@version 1.1: 24 January 2017
 * 			added default method for controllers
 * 		@version 1.2: 27 January 2017
 * 			added XSS prevention and Session protection
*/
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", false);

ini_set('zlib.output_compression_level', 1);

// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

// detect https & avoid CORS issues(Origin Resource Sharing)
$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $isSecure = true;
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
    $isSecure = true;
}

if($isSecure)
	// Uses a secure connection (HTTPS) if possible
	ini_set('session.cookie_secure', 1);


session_start();

// Prevent session hijacking
if(isset($_SESSION['call'])){
	$_SESSION['call']++;
	$newSess = false;
	if($isSecure){ /** https makes session fixation very hard to pull of
					 * so regenerate it less often
					 */
		if(($_SESSION['call'] % 100)==0) $newSess = true;
	}else
		if(($_SESSION['call'] % 5)==0) $newSess = true;
	
	if($newSess){
		$sessData = $_SESSION; // in case session_regenerate_id returns false erase the old session;
		session_destroy();
		session_commit();
		session_regenerate_id('true');
		session_start();
		$_SESSION = $sessData;
		$_SESSION['call'] = 0;
	}
		
}
else
	$_SESSION['call']=0;

require("config.php");
require 'vendor/autoload.php';
require_once 'vendor/propel/config.php';

	/**
	 * Exception & Error Handlers
	 */
	function DB_Logger($exception, $error) {
		
		// propel DB errors
		if($exception instanceof Propel\Runtime\Exception\PropelException){
			error_log(
				str_repeat("=", 10).PHP_EOL.date('Y-m-d H:i:s').PHP_EOL."\t".$exception->getMessage()."\n".var_export($error->toArray(), true)." in ".$exception->getFile()." on line ".$exception->getLine().PHP_EOL,
				3,
				dirname(__FILE__).DIRECTORY_SEPARATOR."system".DIRECTORY_SEPARATOR."Logs".DIRECTORY_SEPARATOR."Database-errors.log",
				1
			);
			
			return true;
		}
		
		
		return false;
	}
	function default_exception_handler(\Exception $e){
		
		$severity = "";
    
		// Trace the error
		$excp = $e->getTrace();
		$fullTrace = array();
		foreach($excp as $exp)
			if(isset($exp['line']))
				$fullTrace[$exp['line']] = $exp['file'];
		$fullTrace = var_export($fullTrace, true);
		
		// Mark error down to custom name
		if ($e instanceof ErrorException) {
   
			switch($e->getSeverity()) 
			{ 
				case E_ERROR: // 1 // 
					$severity = 'E_ERROR'; 
					break;
				case E_WARNING: // 2 // 
					$severity = 'E_WARNING'; 
					break;
				case E_PARSE: // 4 // 
					$severity = 'E_PARSE'; 
					break;
				case E_NOTICE: // 8 // 
					$severity = 'E_NOTICE'; 
					break;
				case E_CORE_ERROR: // 16 // 
					$severity = 'E_CORE_ERROR'; 
					break;
				case E_CORE_WARNING: // 32 // 
					$severity = 'E_CORE_WARNING'; 
					break;
				case E_COMPILE_ERROR: // 64 // 
					$severity = 'E_COMPILE_ERROR'; 
					break;
				case E_COMPILE_WARNING: // 128 // 
					$severity = 'E_COMPILE_WARNING'; 
					break;
				case E_USER_ERROR: // 256 // 
					$severity = 'E_USER_ERROR'; 
					break;
				case E_USER_WARNING: // 512 // 
					$severity = 'E_USER_WARNING'; 
					break;
				case E_USER_NOTICE: // 1024 // 
					$severity = 'E_USER_NOTICE'; 
					break;
				case E_STRICT: // 2048 // 
					$severity = 'E_STRICT'; 
					break;
				case E_RECOVERABLE_ERROR: // 4096 // 
					$severity = 'E_RECOVERABLE_ERROR'; 
					break;
				case E_DEPRECATED: // 8192 // 
					$severity = 'E_DEPRECATED'; 
					break;
				case E_USER_DEPRECATED: // 16384 // 
					$severity = 'E_USER_DEPRECATED';
					break;
			}
		}
		error_log(
			str_repeat("=", 10).PHP_EOL.date('Y-m-d H:i:s').PHP_EOL."\t".$fullTrace.$severity.' thrown within the exception handler. Message: '.$e->getMessage()." on line ".$e->getLine().PHP_EOL,
			3,
			dirname(__FILE__).DIRECTORY_SEPARATOR."system".DIRECTORY_SEPARATOR."Logs".DIRECTORY_SEPARATOR."Exceptions-errors.log",
			1
		);
		http_response_code(500);
		header("Location: ".SITE_URI."/error/500");
		exit;
	}
	function exceptions_error_handler($severity, $message, $filename, $lineno) {
		if (error_reporting() == 0) {
			return;
		}
		if (error_reporting() & $severity) {
			throw new \ErrorException($message, 0, $severity, $filename, $lineno);
		}
	}
	function fatal_handler() {
		$errfile = "unknown file";
		$errstr  = "shutdown";
		$errno   = E_CORE_ERROR;
		$errline = 0;
		
		$error = error_get_last();
		
		if( $error !== NULL) {
		$errno   = $error["type"];
		$errfile = $error["file"];
		$errline = $error["line"];
		$errstr  = $error["message"];
		
			error_log(
				str_repeat("=", 10).PHP_EOL.date('Y-m-d H:i:s').PHP_EOL."\t".$errfile.' '.$errno.' thrown within the exception handler. Message: '.$errstr." on line ".$errline.PHP_EOL,
				3,
				dirname(__FILE__).DIRECTORY_SEPARATOR."system".DIRECTORY_SEPARATOR."Logs".DIRECTORY_SEPARATOR."Fatal-errors.log", 1
			);
			
			http_response_code(500);
			header("Location: ".SITE_URI."/error/500");
		}

	}

	set_error_handler("exceptions_error_handler");
	set_exception_handler("default_exception_handler");
	register_shutdown_function( "fatal_handler" );


	/**
	 * URLRewrite - avoid ending trail issue
	 */
	$urlBase = parse_url($_SERVER['REQUEST_URI']);
	if(!$urlBase)
		list($urlBasePath, $urlBaseQ) = explode('?', $_SERVER['REQUEST_URI']);
	else{
		$urlBasePath = urldecode($urlBase['path']);
		if(isset($urlBase['query']))
			$urlBaseQ = $urlBase['query'];
	}

	// Process only URIs with multiple ending trails
	if(preg_match('%/{2,}%', $urlBasePath)){
		$urlBasePath = preg_replace('%/{2,}%', '/', trim($urlBasePath));
		$siteBase = parse_url(urldecode(SITE_URI));
		
		// Verify and combine the relative paths
		if (preg_match('#^'.preg_quote($urlBasePath).'#i', $siteBase['path'])
			||
			preg_match('#^'.preg_quote($siteBase['path']).'#i', $urlBasePath)
			) {

			$url = $siteBase['scheme'].'://'.$siteBase['host'].$urlBasePath;
			
			if(isset($urlBaseQ) && $urlBaseQ != '')
				$url .= '?'.$urlBaseQ;
			
			header("Location: ".$url);
			exit;
		}
	}

	/**
	 * URLRewrite Parameters 
	 */
    $class = isset($_GET['action']) ? $_GET['action'] : 'Blog'; // default Site index page
    $method = isset($_GET['met']) ? $_GET['met'] : '';
    $reqId = isset($_GET['id']) ? $_GET['id'] : '';
  
	/**
	 * Autoloader 
	 */
	function factory($class) { 
		if ($class[0] != '\\') { 
			
			$class = __NAMESPACE__ . '\\' . $class; 
		} 
		$class = str_replace('-', '', $class);

		return new $class; 
	}
	function autoLoader ($className) {
		$fileName = '';
		$namespace = '';
	
		// Sets the include path as the "src" directory
		$includePath = dirname(__FILE__);
	
		if (false !== ($lastNsPos = strripos($className, '\\'))) {
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
			
		}
		$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
		
		// bypass unix case sensitive file system
		if (preg_match('%(.*?/Controllers/)([a-z])(.*)%', $fileName, $matchParts)) {
			$fileName =  $matchParts['1'].ucfirst($matchParts['2']).$matchParts['3'];
		}
	
		$fullFileName = realpath($includePath . DIRECTORY_SEPARATOR . $fileName);
		
		if (file_exists($fullFileName)) {
			require $fullFileName;
			
			// Check to see whether the include declared the class
			if (!class_exists($className, false) AND !class_exists($namespace.'\\'.$className, false)) {
				http_response_code(400);
				header("Location: ".SITE_URI."/error/400");
				exit;
			}
		}
	}
	spl_autoload_register('autoLoader');
	
	/**
	 * Routing 
	 */
	
    $controller = factory("system\\Controllers\\$class");
	
	// Verify user permission for the requested module
	
	if( $controller->authorise() === false){
		
		$controller->presentation();
		exit;
	}

    // Check to see the method exists or its accessible
    $allowedCalls = get_class_methods($controller);
	$method = str_replace('-', '', $method);
	$exceptions = array('blog'); /* Cases where the Class has a __call and does the URL routing itself
								  * eg. Articles where sluggish url is used and for duplicates it adds an /NR to the url
								  * so it confuses to a proper method called or doesn't contains any spaces
								  */
    if($method != '' && !in_array($method, $allowedCalls) && !in_array($class, $exceptions)
    ){
		http_response_code(405);
        header("Location: ".SITE_URI."/error/405");
        exit;
    }
	
	// default method to call in controllers
	if($method == ''){
		$method = $controller::$defaultMethod;
	}
	
    if(!empty($method) && !in_array($method, array('presentation', 'registerCall', 'validateInput'))){
		$controller->validateInput();
		$controller->registerCall($class.'/'.$method);
		$controller->setRequestedID($reqId);
		$controller->$method();
    }
	/*
	 * End Routing 
	 */
	
	
	/**
	 * Viewer 
	 */
    $controller->presentation();
    
?>