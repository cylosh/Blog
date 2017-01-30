<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Backend extends Core{
    
	public static $permissions = 'admin';

	public static $defaultMethod = 'ControlPanel';
	
    function __construct(){
		$this->HtmlView(array("Backend", "index"));
    }
    
    public function ControlPanel(){
       
    }

}