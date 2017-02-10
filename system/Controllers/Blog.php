<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Blog extends Core{
    
	public static $defaultMethod = 'get';
	
    function __construct(){
		return $this->HtmlView(array("Blog", "index"));
    }
    public function __call($name, $arguments)
    {
		$this->get();
    }
    public function get(){
		
		switch($this->userInput['type']){
			case "R": //new article
				
				// Check if Article was requested
				if (preg_match('%.*?(blog/.{3,}?)(?:\?|$)%i', $_SERVER['REQUEST_URI'], $match)) {
				
					$slugURL = '/'.$match['1'];
				}else
					return $this->HtmlView(array("Blog", "index"));
				
				// request Article Module
				$art = new Article();
				$this->HTMLPath = $art;
				
				$AccDBQ = new \ArticlesQuery();
				//$AccDBQ->filterByEmail($email)->update(array('Status' => '0'));
		
				$dbArt = $AccDBQ->filterByUrl($slugURL)->findOne();
				
				if(!is_null($dbArt)){
					$dbarticle = $dbArt->toArray();
					
					$this->Response = $art->blog($dbarticle['Id']);
					
				}else
					return $this->HtmlView(array("Blog", "index"));
				
				break;
		
			default:
				$this->Response['error-redirect'] = array('redir'=>'/','toCall'=>'/', 'message'=>'Invalid Request!');

		}

    }
    
	// return boolean depending on user permissions
    public function __toString()
    {
        return true;
    }

}