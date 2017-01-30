<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Users extends Core{
    
	public static $permissions = 'user';

	public static $defaultMethod = 'profile';
	
    function __construct(){
		$this->HtmlView(array(USERDOCROOT, "index"));
    }
    
    public function profile(){
       
    }
    public function Settings(){
       
    }
}