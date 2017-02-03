<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Contact extends Core{
    
	public static $defaultMethod = 'index';
	
    function __construct(){
		return $this->HtmlView(array("Blog", "contact"));
    }
    
    public function index(){
		switch($this->userInput['type']){
			case "R": //login verify
				
				if(isset($_SESSION['is_user']) && !empty($_SESSION['userID'])){
					
					$actDB = new \AccountsQuery();
					$account = $actDB->findPk($_SESSION['userID'])->toArray();
					
					if(!is_null($account)){
						$this->safeOutput['data']['name'] = filter_var($account['Fname'].' '.$account['Lname'], FILTER_SANITIZE_STRING);
						$this->safeOutput['data']['email'] = filter_var($account['Email'], FILTER_SANITIZE_STRING);
					}
				}
				
				break;
			
			default:
				$this->Response['error']['alert'] = 'Invalid contact request!';
				
		}
		
    }

    public function send(){
		switch($this->userInput['type']){
			case "C": //login verify
				
				if(isset($_SESSION['is_user']) && !empty($_SESSION['userID'])){
					
					$actDB = new \AccountsQuery();
					$account = $actDB->findPk($_SESSION['userID'])->toArray();
					
					if(!is_null($account)){
						$this->safeOutput['data']['name'] = filter_var($account['Fname'].' '.$account['Lname'], FILTER_SANITIZE_STRING);
						$this->safeOutput['data']['email'] = filter_var($account['Email'], FILTER_SANITIZE_STRING);
					}
				}
				
				break;
			
			default:
				$this->Response['error']['alert'] = 'Invalid contact request!';
		}
		
    }

}