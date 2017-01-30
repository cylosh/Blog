<?php

/**
 * Core: Enables access to core methods and properties of the framework
 *
 * @author : Cylosh
 * @link : https://www.cylo.ro
 * @copyright : https://opensource.org/licenses/MIT
 *
 * @version 1.0: 23 January 2017
 * @version 2: 25 January 2017
 *			added link resolver
 * @version 3: 26 January 2017
 *			added cache capabilities for HTML content
**/
namespace system;

/*
abstract class Page(){


	static permission = 'user, editor, admin';
	function __construct(){

		
	}
	
	
	// daca e comments atunci SESION_USERID == DB_COMMENT_USERID
	// daca e ceva gen Polls atunci daca a votat deja sa vada rezultatele direct
	// cerere catre baza de date catre orice care indica ca are drepturi speciale ca un admin
	function getowner(0){
	}


	function sample(){
	$this->userInput()
	chekc if he owner or has sufficient access
	}
}

*/

class Core{
	
	/*
	 *	Viewer path
	 */
	private $HTMLPath;
	
	/*
	 *	Controller response
	 */
	protected $Response;
	
	/*
	 *	Path for HTML templates
	 */
	protected $templatePath;
	
	
	// static debug = true; // if(debug) log/debug -> add

	function __construct(){
		$this->Response = array();
	}
	
	/**
	 * userInput external input from POST, GET & others - DELETE, PUT
	 *
	 *
	 *
	 * returns array('type'=>,'data'=>)
 	 */
	private function userInput(){
		$method = $_SERVER['REQUEST_METHOD'];
		
		switch(CRUD){
		
		default:
			
		}
		
		
	}
	
	
	/**
	 * linkBridge: Link resolver
	 * 
	 * @param string $html
	 *		Page HTML to fix links for css, images, javascript
	 *		
	 * @return string
	**/
	private function linkBridge($html, $pathToAssets = array('assets/', 'cached-assets/'), $pathToSite=SITE_URI){
		
		// ignore links that already have an address
		$ignores = array('http', 'skype');
		
		$newhtml = '';
		while (preg_match('/href=("|\')(.*?)("|\')/', $html, $link, PREG_OFFSET_CAPTURE)) {
			
			$newhtml .= substr($html,0, $link[2][1]);
			$html = substr($html, $link[2][1]+strlen($link[2][0]));
			
			foreach($ignores as $ignore)
				if(preg_match('/^'.preg_quote($ignore).'/', $link[2][0])){
				$newhtml .= $link[2][0];
				continue 2;
				
				}
			
			$newhtml .= $pathToSite.'/'.$link[2][0];
		}
		$newhtml .= $html;
		
		foreach($pathToAssets as $pathToAsset){
		
			$newhtml = preg_replace_callback ('%("|\')'.preg_quote($pathToAsset).'%',
				function($matches) use ($pathToAsset, $pathToSite){
				
				return $matches[1].$pathToSite.'/'.$pathToAsset;
				}
			, $newhtml);
		}
		
		return $newhtml;
	}
	
	
	/**
	 * HtmlView: Sets path for controller
	 * 
	 * @param array $location
	 *		order of directories and file to get the HTML content
	 *		
	 * @return boolean;
	**/
	protected function HtmlView(array $location){
		
		$path = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $location).'.php';
		
		// Treat as invalid request if no HTML template is set;
		if(!file_exists($path)){
			http_response_code(503);
			header("Location: ".SITE_URI."/error/503");
			exit;
		}
		
		$this->HTMLPath = realpath($path);
		
		return true;
	}
	
	
	/**
	 * authorise: Grant Access manager
	 * 		
	 * @returns boolean depending on permissions of current user
	 */
    public function authorise(){
	
		// Allow access if module has no permission set
		if(!property_exists($this, 'permissions') OR empty($this::$permissions))
			return true;
		
		$perms = explode(',', $this::$permissions);

		if (in_array("admin", $perms)) {
			if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === TRUE)
				return true;
			else{
				$this->Response['error-redirect'] = array('redir'=>'/login','toCall'=>'login/login', 'message'=>'Access denied!');
				return false;
			}
		}
		if (in_array("user", $perms)) {
			if(isset($_SESSION['is_user']) && $_SESSION['is_user'] === TRUE)
				return true;
			else{
				$this->Response['error-redirect'] = array('redir'=>'/login','toCall'=>'login/login', 'message'=>'You have to be logged in!');
				return false;
			}
		}
		
		if(!isset($_SESSION['user_session_start'])
			||
			($_SESSION['user_session_start'] + USER_SESSION) < time()
		){
			$this->Response['error-redirect'] = array('redir'=>'/login','toCall'=>'login/login', 'message'=>'Your session expired. Please re-login!');
			return false;
		}
		
		return false;
		/* if($this->permission > $permissions){
		
			// si in plus daca $this->permission $this->userInput e post sau update atunci $this->getowner si s
		} */
    }
    
	/**
	 * GetTemplate: Retrieve template based on user permission
	 * 
	 * @param string $template
	 * @return boolean
	 */
	public function GetTemplate($template){
		
		$common = DIRECTORY_SEPARATOR.'commons'.DIRECTORY_SEPARATOR.$template.".php";
		// check access file
		if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === TRUE && file_exists(ADMINDOCROOT.$common))
			return realpath(ADMINDOCROOT.$common);
		elseif(isset($_SESSION['is_user']) && $_SESSION['is_user'] === TRUE && file_exists(USERDOCROOT.$common))
			return realpath(USERDOCROOT.$common);
		elseif(file_exists(DOCROOT.$common)) // reverse to public templates
			return realpath(DOCROOT.$common);
		else{
			http_response_code(503);
			header("Location: ".SITE_URI."/error/503");
			exit;
		}
		
		exit;
	}
    
	/**
	 * RegisterCall: -store the previously called methods
	 *				-will also push into Viewer the previous Error via session
	 * 
	 * @param string $caller
	 *		class/method to check
	 *		
	 * @return boolean
	 */
	public function registerCall($caller){
		if(!empty($_SESSION['error']) && preg_match('%'.preg_quote($_SESSION['controller']).'%i',$caller))
			$this->Response['error'] = $_SESSION['error'];
			
		unset($_SESSION['error']);
		$_SESSION['controller'] = $caller;
	}

	/**
	 * presentation: Framework Viewer
	 * 
	 * @param string $type
	 *		default content to request
	 *		
	 * @return string $content
	**/
    public function presentation($type='html'){
		
		$content = '';
		
		if(!is_array($this->Response))
			$this->Response = array();
			
		if(count($this->Response) < 1)
			$this->Response['success'] = true;
		
		// Process redirects differently for API and HTML views
		// eg. if user wants to place a comment but session expired he will be redirected to login form
		$redirect = false;
		
		if(isset($this->Response['error-redirect'])){
			$this->Response['error'] = $_SESSION['error'] = $this->Response['error-redirect']['message'];
			$_SESSION['controller'] = $this->Response['error-redirect']['toCall'];
			$redirect = $this->Response['error-redirect']['redir'];
			unset($this->Response['error-redirect']);
		}
		
		// get content shipping method
		if(isset($_GET['json'])){
		
			$_SESSION['shipment'] = 'json';
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 7 Aug 1989 05:00:00 GMT');
			header('Content-type: application/json');

			$content = json_encode($this->Response);
		}
		elseif(isset($_GET['xml'])){
			include "Packages/Array2XML.php";
			$_SESSION['shipment'] = 'xml';
			header("Content-Type: application/xml;");
			$xml = \Array2XML::createXML('response', $this->Response);
			
			$content = sanitizeXML($xml->saveXML());
			
		}else{ //default html
			$_SESSION['shipment'] = 'html';

			if($redirect && !empty($redirect)){
				header("Location: ".SITE_URI.$redirect);
				exit;
			}
			
			 // ENABLE COMPRESSION for HTML
			ob_end_clean();
			ob_start("ob_gzhandler");
			if(file_exists($this->HTMLPath)) include $this->HTMLPath; 
			$content = $this->linkBridge(ob_get_clean());
			if(empty($content)){
				header("Location: ".SITE_URI);
				exit;
			}
			// Determine supported compression method
			$gzip = strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip');
			$deflate = strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'deflate');
			
			// Determine used compression method
			$encoding = $gzip ? 'gzip' : ($deflate ? 'deflate' : false);

			if($encoding){
				$content = gzencode(trim( preg_replace( '/\s+/', ' ', $content ) ), 9);
				header('Content-Encoding: '.$encoding);
				header('Vary: Accept-Encoding');
			}
			$offset = 60 * 60 * 24;
			$expire = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
			header("content-type: text/html; charset=UTF-8");
			header( $expire );
			header("Cache-Control: max-age=".$offset);
			header('Content-Length: ' . strlen( $content ) );

		}
		
		print $content;
	}
	
	
}



