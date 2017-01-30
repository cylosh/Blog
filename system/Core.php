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
	
	
	/*
	 *	Parameters receieved from client
	 */
	protected $userInput;
	/*
	 *	$userInput secured data
	 */
	protected $safeOutput;
	
	/*
	 *	Array containing user alerts
	 */
	public $Alert;
	
	
	// static debug = true; // if(debug) log/debug -> add

	function __construct(){
		$this->Response = array();
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
	 * HTMLAlerts: display alerts
	 *
	 * @param array $alerts
	 *		error/notices in array
	 *		
	 *
	 * returns $content
 	 */
	public function HTMLAlerts($alerts)
	{
		$content = '';

		if(is_array($alerts)){
		
			foreach($alerts as $type => $alert){
				
				if(!is_array($alert))
					continue;
					
				foreach($alert as $message){
					switch((string)$type){
						
						case "alert":
							$content .= $this->BootstrapAlert($message, 'danger');

							break;
						
						case "warn":
							$content .= $this->BootstrapAlert($message, 'warning', true);
							break;
						
						case "good":
							$content .= $this->BootstrapAlert($message, 'success', true);
							break;
					
						default:
							$content .= $this->BootstrapAlert($message, 'info', true);
					}
				}
				
				if(!empty($content)) $content .= PHP_EOL;
			}
			
		}
		
		return trim($content);
	}
	
	public function BootstrapAlert($message, $type = 'info', $close = false){

	//success, info, warning, danger
		
		$body = '<div class="alert alert-'.$type.' fade in" style="text-align:left;">';
		if($close) $body .= '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>';
		switch($type){
			case 'success': $body .= '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>'; break;
			case 'info': $body .= '<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>'; break;
			case 'warning': $body .= '<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>'; break;
			case 'danger': $body .= '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>'; break;
		}
		$body .= '&nbsp;<span style="font-size:120%">'.preg_replace(array('#&lt;(/?(?:pre|b|em|u|ul|br|a.*?))&gt;#', '#&amp;#'), array('<\1>', "&"), htmlspecialchars($message, ENT_NOQUOTES)).'</h6>';
		$body .= '</div>';

		return $body;
	}
	
	/**
	 * validateInput: manipulate external input from POST, GET, DELETE, PUT
	 *
	 * returns array('type'=>,'data'=>)
 	 */
	public function validateInput(){
	
		$method = $_SERVER['REQUEST_METHOD'];

		switch($method){
			case "POST":
				$this->userInput['type'] = 'C';
				$data = file_get_contents("php://input");
				
				if(empty($data))	
					$this->userInput['data'] = $_POST;
				else{
					$this->userInput['data'] = json_decode($data);

					if (json_last_error() === JSON_ERROR_NONE) {
						$this->userInput['data'] = (array)$this->userInput['data'];
					}else{
						parse_str($data, $this->userInput['data']);
					}
				}
				break;
				
			case "PUT":
			
				$this->userInput['type'] = 'U';
				
				$data = file_get_contents("php://input");
				$this->userInput['data'] = json_decode($data);

				if (json_last_error() === JSON_ERROR_NONE) {
					$this->userInput['data'] = (array)$this->userInput['data'];
				}else{
					parse_str($data, $this->userInput['data']);
				}
				
				break;
				
			case "DELETE":
			
				$this->userInput['type'] = 'D';
				
				$data = file_get_contents("php://input");
				$this->userInput['data'] = json_decode($data);

				if (json_last_error() === JSON_ERROR_NONE) {
					$this->userInput['data'] = (array)$this->userInput['data'];
				}else{
					parse_str($data, $this->userInput['data']);
				}
				break;
			
			default:
				$this->userInput['type'] = 'R';
				$this->userInput['data'] = $_GET;
		}

		// Sanitize Data
		/**
		 * Sanitize a multidimensional array
		 *
		 * @uses htmlspecialchars
		 *
		 * @param (array)
		 * @return (array) the sanitized array
		 */
		$sanitize = function ($data, $type='high') use(&$sanitize) {
			if (!is_array($data) || !count($data)) {
				return array();
			}
			$data = array_filter($data);
			foreach ($data as $k => $v) {
				if (!is_array($v) && !is_object($v)) {
					$data[$k] = trim($v);
					
					if($type=='high')
						$data[$k] = htmlspecialchars($data[$k], ENT_QUOTES, 'utf-8');
				}
				if (is_array($v)) {
					$data[$k] = $sanitize($v, $type);
				}
			}
			return $data;
		};
		
		$this->userInput = $sanitize($this->userInput, 'low');
		$this->safeOutput = $sanitize($this->userInput);
		
		return $this->safeOutput;
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
			$this->Response['error']['warn'][] = $_SESSION['error'];
			
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
			$this->Response['error']['alert'] = $_SESSION['error'] = $this->Response['error-redirect']['message'];
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
			
			if(isset($this->Response['error']) && is_array($this->Response['error']))
				$this->Alert = $this->HTMLAlerts($this->Response['error']);
			
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



