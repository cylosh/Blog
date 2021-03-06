<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Register extends Core{
    
	public static $defaultMethod = 'create';
    function __construct(){
		// check if already logged in
		if(isset($_SESSION['is_user']))
			return $this->Response['redirect'] = array("message"=>"Already logged in", "url"=>'/');
    }
    
    public function create(){
        return $this->HtmlView(array("Users", "register"));
    }

}