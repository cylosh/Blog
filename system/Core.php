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

	// return boolean depending on user permissions
	function __static{
		return $this->authorise();
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
	 *	View path
	 */
	private $HTMLPath;
	
	
	// static debug = true; // if(debug) log/debug -> add

	// function __construct(){
		// $permissions = ['admin'=>0, 'user'=>1];
		
	// }
	
	
	// function error(){
		// $caller = new $error;
		// return $caller;
	// }
	
	// parse external input from POST, GET & others - DELETE, PUT
	/*
	 * returns array('type'=>,'data'=>)
 	 */
	// protected function userInput(){
		// $method = $_SERVER['REQUEST_METHOD'];
		
		// switch(CRUD){
		
		// default:
			// READ;
		// }
		
		
	// }
	
	
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
		
		if(!file_exists($path)){
			
			header("Location: ".SITE_URI."/error/503");
			exit;
		}
		
		$this->HTMLPath = $path;
		
		return true;
	}
	
	
	/**
	 * authorise: Grant Access manager
	 * 
	 * @param string $type
	 *		default content to request
	 *		
	 * @return string $content
	**/
    protected function authorise(){
        echo "content ".$this->var;
                var_dump($_SESSION);
		/* if($this->permission > $permissions){
		
			// si in plus daca $this->permission $this->userInput e post sau update atunci $this->getowner si s
		} */
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
		
		// get content shipping method
		if(isset($_GET['json']))
			$_SESSION['shipment'] = 'json';
		elseif(isset($_GET['xml']))
			$_SESSION['shipment'] = 'xml';
		elseif(!isset($_SESSION['shipment']) OR isset($_GET['html']))
			$_SESSION['shipment'] = $type;
		
		if($_SESSION['shipment'] != 'html')
			header("Content-Type: application/{$_SESSION['shipment']}; charset=utf-8");
		
		else{ // ENABLE COMPRESSION for HTML
			
			ob_start("ob_gzhandler");
			include $this->HTMLPath;
			$content = $this->linkBridge(ob_get_clean());
			
			// Determine supported compression method
			$gzip = strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip');
			$deflate = strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'deflate');
			
			// Determine used compression method
			$encoding = $gzip ? 'gzip' : ($deflate ? 'deflate' : false);

			if($encoding){
				$content = gzencode(trim( preg_replace( '/\s+/', ' ', $content ) ), 9);
				$offset = 60 * 60 * 24;
				$expire = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
				header('Content-Encoding: gzip');
				header("content-type: text/html; charset=UTF-8");
				header( $expire );
				header("Cache-Control: max-age=".$offset);
				header('Content-Length: ' . strlen( $content ) );
				header('Vary: Accept-Encoding');
			}
		}
		
		print $content;
	}
	
	
}



