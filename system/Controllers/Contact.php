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
				
				if(empty($this->userInput['data']['email']) || !filter_var($this->userInput['data']['email'], FILTER_VALIDATE_EMAIL))
					$this->Response['error']['alert'][] = 'Oops invalid email address!';
				else
					$email = $this->userInput['data']['email'];
				
				if(empty($this->userInput['data']['name']))
					$this->Response['error']['warn'][] = 'Oops your name is missing!';
				else
					$name = filter_var ($this->userInput['data']['name'], FILTER_SANITIZE_STRING);
					
				if(empty($this->userInput['data']['message']))
					$this->Response['error']['warn'][] = 'Oops the message is empty!';
				else
					$name = filter_var ($this->userInput['data']['name'], FILTER_SANITIZE_STRING);
				
				if(!isset($this->Response['error'])
				   || !is_array($this->Response['error'])
				   || count($this->Response['error']) == 0
				   )
					$this->Response['success'] = 'Your message was sent successfully!';
				
				break;
			
			case "R":
				$this->index();
				break;
			
			default:
				$this->Response['error']['alert'] = 'Invalid contact request!';
		}
		
    }

}