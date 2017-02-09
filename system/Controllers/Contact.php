<?php
namespace system\Controllers;

use \system\Core;
use \Propel\Runtime\Exception\PropelException;

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
				elseif(strlen($this->userInput['data']['name']) < 3)
					$this->Response['error']['warn'][] = 'Oops your name is too short!';
				else
					$name = filter_var ($this->userInput['data']['name'], FILTER_SANITIZE_STRING);
					
				if(empty($this->userInput['data']['message']))
					$this->Response['error']['warn'][] = 'Oops the message is empty!';
				elseif(strlen($this->userInput['data']['message']) < 100)
					$this->Response['error']['warn'][] = 'Oops your message needs to be longer than 100 characters!';
				else
					$message = filter_var ($this->userInput['data']['message'], FILTER_SANITIZE_STRING);
			
				$phone = empty($this->userInput['data']['phone']) ? '' : $this->userInput['data']['phone'];
				$user = empty($_SESSION['userID']) ? '' : $_SESSION['userID'];
				
				if(!isset($this->Response['error'])
				   || !is_array($this->Response['error'])
				   || count($this->Response['error']) == 0
				   ){
					
					try{
						$db_contact = new \Contact();
						$db_contact->setUserId($user);
						$db_contact->setName($name);
						$db_contact->setEmail($email);
						$db_contact->setMessage($message);
						$db_contact->setDate("now");
						$db_contact->save();
						$this->Response['success'] = 'Your message was sent successfully!';

					}catch(PropelException $e){
						$this->Response['error']['alert'] = 'Oops database error, please try again later!';
						
						DB_Logger($e, $db_contact);
					}
				   }
				
				break;
			
			case "R":
				$this->index();
				break;
			
			default:
				$this->Response['error']['alert'] = 'Invalid contact request!';
		}
		
    }

}