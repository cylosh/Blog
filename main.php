<?php

/**
 * main: Handles routing & control operations for the application
 *
 * @author : Cylosh
 * @link : https://www.cylo.ro
 * @copyright : https://opensource.org/licenses/MIT

 * @version 1.0: 23 January 2017
*/

session_start();
require("config.php");

	/*
	 * URLRewrite - avoid ending trail issue
	 */
	if(substr($_SERVER['REQUEST_URI'], -1) === '/'){
		$url = rtrim($_SERVER['REQUEST_URI'], "/ \t\n\r");
		if (!preg_match('#'.preg_quote($url).'$#i', SITE_URI)) {
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