<?php

/**
 * Core: Enables access to core methods of the application
 *
 * @author : Cylosh
 * @link : https://www.cylo.ro
 * @copyright : https://opensource.org/licenses/MIT

 * @version 1.0: 23 January 2017
*/
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
	
	// include Page template
	protected function HtmlView(array $location){

		$path = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $location).'.php';

		if(!file_exists($path)){
			
			#header("Location: ".SITE_URI."/error/503");
			exit;
		}
		
		$this->HTMLPath = $path;
		
		return true;
	}
	
    protected function authorise(){
        echo "content ".$this->var;
                var_dump($_SESSION);
		/* if($this->permission > $permissions){
		
			// si in plus daca $this->permission $this->userInput e post sau update atunci $this->getowner si s
		} */
    }
    
    public function presentation(){
		// get content shipping method
		if(isset($_GET['json']))
			$_SESSION['shipment'] = 'json';
		elseif(isset($_GET['xml']))
			$_SESSION['shipment'] = 'xml';
		elseif(!isset($_SESSION['shipment']) OR isset($_GET['html']))
			$_SESSION['shipment'] = 'html';
		
		if($_SESSION['shipment'] == 'html')
			header("Content-Type: text/{$_SESSION['shipment']}; charset=utf-8");
		else
			header("Content-Type: application/{$_SESSION['shipment']}; charset=utf-8");
		
		
		include $this->HTMLPath;
	}
	
	
}


