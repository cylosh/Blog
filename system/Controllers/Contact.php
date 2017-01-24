<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Contact extends Core{
    
	public static $defaultMethod = 'index';
	
    function __construct(){
    }
    
    public function index(){
        return $this->HtmlView(array("Blog", "contact"));
    }
    
	// return boolean depending on user permissions
    public function __toString()
    {
        return true;
    }

}