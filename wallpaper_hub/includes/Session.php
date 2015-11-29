<?php

class Session{
	private  $logged_in=false;
	//public $user_id;
	public $user_name;
	function __construct(){
		session_start();
		$this->check_login();
		if($this->logged_in){
		
		}else{
			
		}
	}
	public function login($user){
		if($user){
			$this->user_name=$_SESSION['user_name']=$user["user_name"];
			$this->logged_in=true;
		}
	}
	public function logout(){
		unset($_SESSION['user_name']);
		unset($this->user_name);
		$this->logged_in=false;
	}
	private function check_login(){
		if(isset($_SESSION['user_name'])){
			$this->user_name=$_SESSION['user_name'];
			$this->logged_in=true;
		}
		else{
			unset($this->user_name);
			$this->logged_in=false;
		}
	}
	public function is_logged_in(){
		return $this->logged_in;
	}
}
$session=new Session();
?>