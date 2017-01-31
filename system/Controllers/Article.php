<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Article extends Core{
    
	public static $defaultMethod = 'blog';
	
    function __construct(){
		return $this->HtmlView(array("Blog", "article"));
    }
    
    public function blog($article_id = ''){
		
		if(empty($article_id))
			$article_id = $this->RequestID;
			
		$article = \ArticlesQuery::create()->findPk($article_id);
		
		if(is_null($article)){
			return $this->Response = array("error-redirect"=>array('redir'=>'/blog','toCall'=>'/', 'message'=>'Invalid Article!'));
		}
		
		return $this->Response = $article->toArray();
		
    }
    
	// return boolean depending on user permissions
    public function __toString()
    {
        return $this->HTMLPath;
    }

}