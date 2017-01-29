<?php
namespace system\Controllers;

use \system\Core;
use system\Models\Accounts;

defined("SITE_URI") OR die(header("Location: error/403"));

require_once 'vendor/propel/config.php';

class Login extends Core{
    	
	public static $defaultMethod = 'login';
    function __construct(){
    }
    
    public function login(){
        return $this->HtmlView(array("Users", "login"));
    }
	
    public function check(){
		
		$class = new Accounts();

		$class->setFname("das");
		$zeroDate = new \DateTime("NOW");
		$zeroDate = $zeroDate->format('Y-m-d H:i:s');

		$class->save();
    }
    
	// return boolean depending on user permissions
    public function __toString()
    {
        return true;
    }

}