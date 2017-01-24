<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Blog extends Core{
    
	public static $defaultMethod = 'get';
	
    function __construct(){
		
    }
    
    public function get(){
        return $this->HtmlView(array("Blog", "index"));
    }
    
	// return boolean depending on user permissions
    public function __toString()
    {
        return true;
    }

}