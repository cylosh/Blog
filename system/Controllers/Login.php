<?php
namespace system\Controllers;

use \system\Core;
use system\Models\Accounts;

defined("SITE_URI") OR die(header("Location: error/403"));

require_once 'vendor/propel/config.php';

class Login extends Core{
    	
	public static $permissions = '0';
	public static $defaultMethod = 'login';
	
    function __construct(){
		$this->HtmlView(array("Users", "login"));
    }
    
    public function login(){
	
    }
	
    public function check(){

		
		return $this->Response['error-redirect'];
		
		/* $class = new Accounts();

		$class->setFname("das");
		$zeroDate = new \DateTime("NOW");
		$zeroDate = $zeroDate->format('Y-m-d H:i:s');

		$class->save(); */
    }
}