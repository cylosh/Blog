<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Register extends Core{
    
	public static $defaultMethod = 'signup';
    function __construct(){
    }
    
    public function signup(){
        return $this->HtmlView(array("Users", "register"));
    }
    
	// return boolean depending on user permissions
    public function __toString()
    {
        return true;
    }

}