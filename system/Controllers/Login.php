<?php
namespace system\Controllers;

use \system\Core;
use system\Models\Accounts;

defined("SITE_URI") OR die(header("Location: error/403"));

class Login extends Core{
    	
	public static $defaultMethod = 'login';
    function __construct(){
    }
    
    public function login(){
        return $this->HtmlView(array("Users", "login"));
    }
	
    public function check(){
		$this->HtmlView(array("Users", "login"));
		require_once 'vendor/propel/config.php';
		$class = new Accounts();

		$class->setName("das");
		$zeroDate = new \DateTime("NOW");
		$zeroDate = $zeroDate->format('Y-m-d H:i:s');

		$class->setCreated($zeroDate);
		$class->save();
    }
    
	// return boolean depending on user permissions
    public function __toString()
    {
        return true;
    }

}