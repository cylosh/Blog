<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Article extends Core{
    
	public static $defaultMethod = 'blog';
	
    function __construct(){
    }
    
    public function blog(){
        return $this->HtmlView(array("Blog", "article"));
    }
    
	// return boolean depending on user permissions
    public function __toString()
    {
        return true;
    }

}