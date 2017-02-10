<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Register extends Core{
    
	public static $defaultMethod = 'signup';
    function __construct(){
		// check if already logged in
		if(isset($_SESSION['is_user']))
			return $this->Response['redirect'] = array("message"=>"Already logged in", "url"=>'/');
    }
    
    public function create(){
        return $this->HtmlView(array("Users", "register"));
    }
    
	// return boolean depending on user permissions
    public function __toString()
    {
        return true;
    }

}