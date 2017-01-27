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

ini_set('zlib.output_compression_level', 1);

// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);

// Uses a secure connection (HTTPS) if possible
ini_set('session.cookie_secure', 1);

// detect https & avoid CORS issues(Origin Resource Sharing)
$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $isSecure = true;
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
    $isSecure = true;
}

session_start();

require("config.php");

	/*
	 * URLRewrite - avoid ending trail issue
	 */
	$urlBase = parse_url($_SERVER['REQUEST_URI']);
	if(!$urlBase)
		list($urlBasePath, $urlBaseQ) = explode('?', $_SERVER['REQUEST_URI']);
	else{
		$urlBasePath = urldecode($urlBase['path']);
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
			
			if($urlBaseQ != '')
				$url .= '?'.$urlBaseQ;
			
			header("Location: ".$url);
			exit;
		}
	}

	/*
	 * URLRewrite Parameters 
	 */
    $class = isset($_GET['action']) ? $_GET['action'] : 'Blog'; // default Site index page
    $method = isset($_GET['met']) ? $_GET['met'] : '';
    $reqId = isset($_GET['id']) ? $_GET['id'] : '';
  
	/*
	 * Autoloader 
	 */
	function factory($class) { 
		if ($class[0] != '\\') { 
			
			$class = __NAMESPACE__ . '\\' . $class; 
		} 
		
		return new $class(); 
	} 
	spl_autoload_register(
		function ($className) {
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

			$fullFileName = $includePath . DIRECTORY_SEPARATOR . $fileName;
			
			if (file_exists($fullFileName)) {
				require $fullFileName;
				
				// Check to see whether the include declared the class
				if (!class_exists($className, false) AND !class_exists($namespace.'\\'.$className, false)) {
					header("Location: ".SITE_URI."/error/400");
					exit;
				}
			} else {
			
				header("Location: ".SITE_URI."/error/501");
				exit;
			}
		}

	);
	
	/*
	 * Routing 
	 */
    $controller = factory("system\\Controllers\\$class");
	
	if($controller === false) $controller->error->accessDeny();
	
    // Check to see the method exists or its accessible
    $allowedCalls = get_class_methods($controller);
	
    if($method != '' && !in_array($method, $allowedCalls)
    ){
        header("Location: ".SITE_URI."/error/405");
        exit;
    }
	
	// default method to call in controllers
	if($method == ''){
		$method = $controller::$defaultMethod;
	}
    
    if(!empty($method) && $method!='presentation'){
        $controller->$method();
    }
	/*
	 * End Routing 
	 */
	
	/*
	 * Viewer 
	 */
    $controller->presentation();
    
?>