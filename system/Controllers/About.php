<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class About extends Core{
    
    function __construct(){
    }
    
    public function get(){
        return $this->HtmlView(array("Blog", "about"));
    }
    
	// return boolean depending on user permissions
    public function __toString()
    {
        return true;
    }

}