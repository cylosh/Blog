<?php

/**
 * Core: Enables access to core methods and properties of the framework
 *
 * @author : Cylosh
 * @link : https://www.cylo.ro
 * @copyright : https://opensource.org/licenses/MIT
 *
 * @version 1.0: 23 January 2017 {commit b9d9878bd6b8bb7bbf185fdf77ea8efa3057f28c}
 * 
 * @version 2: 25 January 2017 {commit d0b3cc98289a21472d10dede53d4285df52bea59}
 *			added link resolver
 *			
 * @version 3: 26 January 2017 {commit c2fe8d0a7bb77ba93c0dcd5d4ff9385c409f261c}
 *			added cache capabilities for HTML content
 *			
 * @version 4: 29 January 2017 {commit 40dc3c3f0d41e2436f337b859db6b2db0973dc86}
 *			added XML support
 *			
 * @version 5: 30 January 2017 {commit 40eb68039be39ba1510da6876302c7d47d8294b3}
 *			added user rights manager
 *			added template viewer based on user rights
 *			added API support for presentation()
 * @version 5.1: 30 January 2017 {commit bc5a506460c573f384d4e72325d14f5959a76607}
 * 			implemented security on incoming data from client and sanitize Output
 * @version 5.2: 31 January 2017 {commit b94ad2c24053d9f96dd3036c47436373b852a7f3}
 * 			added redirect to URI along with error message for client
 * @version 5.3: 31 January 2017 {commit 3060d75fb33e4707537217988404859399963094}
 * 			bug fix for redirection in loop
 * 			added user permission option for keep-logged in

 * @version 6: 31 January 2017 {commit f1b9b1c19d9ecbab5bbad948afede6d05c792711}
 * 			added
 * @version 6.1: 3 February 2017
 * 			fix $Response->alert type cast only to array
 *			
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
	protected $HTMLPath;
	
	
	/*
	 *	Path for HTML templates
	 */
	protected $templatePath;
	
	
	/*
	 *	ID of Method requested by client
	 */
	protected $RequestID;
	
	
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
	
	/*
	 *	Controller response
	 */
	public $Response;
	
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
		while (preg_match('/(?:href|action)=("|\')(.*?)("|\')/', $html, $link, PREG_OFFSET_CAPTURE)) {
			
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
		
		return $this->HTMLPath;
	}
	
	/**
	 * Mime: Provides mime support by attempting to use
	 * multiple PHP functions like finfo_open, getimagesize
	 * and exif_imagetype - whichever is allowed to run
	 * on the PHP installation
	 *
	 * @version 1.0: 31 Jan 2017
	 *		build with gif, png, jpg and mp3 file supports
	 *
	 * @param string $path
	 *		Path of the file to get mime from
	 * @return string
	 */
    protected function Mime($path)
    {
		$filetype = '';
		
		if (is_file($path) === true && filesize($path)!= 0) {
			
			if (function_exists('finfo_open') === true) {
				$finfo = finfo_open(FILEINFO_MIME_TYPE);
				
				if (is_resource($finfo) === true) {
					$filetype = finfo_file($finfo, $path);
				}
				
				finfo_close($finfo);
				
			} elseif (function_exists('getimagesize')) {
				$file_info = getimagesize($path);
				$filetype  = image_type_to_mime_type($file_info['2']);
			} elseif (function_exists('exif_imagetype') === true) {
				$filetype = image_type_to_mime_type(exif_imagetype($path));
			}
		}
		
		
		switch (strtolower($filetype)) {
			case 'image/gif':
			return '.gif';
			break;
			case 'image/png':
			return '.png';
			break;
			
			case 'image/jpeg':
			return '.jpg';
			break;
			
			case 'audio/mpeg':
			case 'application/octet-stream':
			return '.mp3';
			break;
			
			default:
			return $filetype;
		}
	
    }
	
	public function setRequestedID($id){
		$this->RequestID = $id;
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
					$alert = array($alert);
					
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
		
		// Make sure we don't loop around here
		if(isset($_SESSION['authorise'])){
			unset($_SESSION['authorise']);
			return;
		}
		
		// Allow access if module has no permission set
		if(!property_exists($this, 'permissions') OR empty($this::$permissions))
			return true;
		
		// Log out user after USER_SESSION
		if(isset($_SESSION['user_session_start'])
			&&
			($_SESSION['user_session_start'] + USER_SESSION) < time()
		){
			$_SESSION['authorise'] = true;
			$this->Response['error-redirect'] = array('redir'=>'/login/out','toCall'=>'login/out', 'message'=>'Your session expired. Please re-login!');
			
			unset($_SESSION['user_session_start']);
			
			return false;
		}elseif(isset($_SESSION['user_session_start']) && isset($_SESSION['user_session_interval']))
			$_SESSION['user_session_start']	= time()+$_SESSION['user_session_interval'];
		
		
		// Check user rights	
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
		
		
		return false;
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
		
		if(isset($this->Response['redirect'])){
			$redirect = $this->Response['redirect']['url'];
			
			$this->Response['message'] = $this->Response['redirect']['message'];
			unset($this->Response['redirect']);
		}
		
		// get content shipping method
		if(isset($_GET['json'])){
		
			$_SESSION['shipment'] = 'json';
			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 7 Aug 1989 05:00:00 GMT');
			header('Content-type: application/json');
			if(isset($this->Response['error']))
				http_response_code(406);
				
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
			if (ob_get_length()) ob_clean();
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
			header("content-type: text/html; charset=UTF-8");
			header('Expires: Mon, 7 Aug 1989 05:00:00 GMT');
			header('Cache-Control: no-cache, must-revalidate');
			header('Content-Length: ' . strlen( $content ) );

		}
		
		print $content;
	}
	
	
}



