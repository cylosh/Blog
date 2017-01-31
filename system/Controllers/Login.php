<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));


class Login extends Core{
    	
	public static $permissions = '0';
	public static $defaultMethod = 'login';
	
    function __construct(){
		$this->HtmlView(array("Users", "login"));
    }
    
    public function out(){
		
		// Unset all of the session variables.
		$_SESSION = array();
		
		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		
		// Finally, destroy the session.
		session_destroy();
		
		if(isset($this->Response['error'])) // eg. Session expired notices
			return;
		
		$this->Response['redirect'] = array("message"=>"Successfully logged out", "url"=>'/');
	}
	
    public function login(){
		switch($this->userInput['type']){
			case "C": //login verify
				
				// verify email
				if(!empty($this->userInput['data']['uname'])
				   && filter_var($this->userInput['data']['uname'], FILTER_VALIDATE_EMAIL)
				){
					$email = $this->userInput['data']['uname'];
				}else{
					return $this->Response['error']['alert'][] = 'Oops invalid Email!';
				}
				
				//verify password
				if(!empty($this->userInput['data']['password'])){
					if(filter_var($this->userInput['data']['password'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/\A(?=[\x20-\x7E]*?[A-Z])(?=[\x20-\x7E]*?[a-z])(?=[\x20-\x7E]*?[0-9])[\x20-\x7E]{6,}\z/")))){
						$password = $this->userInput['data']['password'];
					}else{
						return $this->Response['error']['alert'][] = 'Oops invalid password!';
					}
				}else{
					return $this->Response['error']['alert'][] = 'Oops no password entered!';
				}
		
				// match password with records
				
				$AccDBQ = new \AccountsQuery();
				//$AccDBQ->filterByEmail($email)->update(array('Status' => '0'));
		
				$dbUser = $AccDBQ->filterByEmail($email)->findOne();
				if(is_null($dbUser)){
					return $this->Response['error']['alert'][] = 'Ooops your account was not found!';
				}
				
		
				$userData = $dbUser->toArray(); 
				
				if($userData['Password'] === crypt($password, $userData['Password'])){//password match
					$_SESSION['is_user'] = true;
					$_SESSION['userID'] = $userData['Id'];
					
					if($userData['Status'] === 0){	// admin
						$_SESSION['is_admin'] = true;
						$url = '/'.ADMINDOCROOT;
					}else
						$url = '/'.USERDOCROOT;
				}else
					return $this->Response['error']['alert'][] = 'Ooops password doesn\'t match!';
				
				$_SESSION['user_session_start'] = time();
				
				// Stay sign in 
				if(isset($this->userInput['data']['persist'])
				   && $this->userInput['data']['persist']==='on'
				)
					$_SESSION['user_session_interval'] = 86400;
				else
					$_SESSION['user_session_interval'] = USER_SESSION;
					
					
				return $this->Response['redirect'] = array("message"=>"Successfully logged in", "url"=>$url);
				
				break;
			
			
			
			case "U":
			case "D":
				$this->Response['error']['alert'][] = 'Invalid login request!';
				break;
			
			
			
			case "R":
				if(isset($_SESSION['is_user']))
					return $this->Response['redirect'] = array("message"=>"Already logged in", "url"=>'/');
		}
    }
}