<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Login extends Core{
    	
	public static $defaultMethod = 'login';
    function __construct(){
    }
    
    public function login(){
        return $this->HtmlView(array("Users", "login"));
    }
    
	// return boolean depending on user permissions
    public function __toString()
    {
        return true;
    }

}