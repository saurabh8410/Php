<?php
require_once("database_class.php");
	class User
	{	
		public $id;
		public static function authenticate($username="",$pass=""){
			global $database;
			$qry="select * from tblusers where user_name='{$username}' and password='{$pass}' Limit 1 ";
			$result_set=$database->query($qry);
			$user_array=$database->fetch_array($result_set);
			return !empty($user_array)? $user_array : NULL;
		}
		public static function create_user($fname,$lname,$gender,$mail,$mob,$uname,$pass)
		{
			global $database;
			
			$qry="insert into tblusers (user_name,password,first_name,last_name,gender,mail,mobile) values(
			      '{$uname}','{$pass}','{$fname}','{$lname}','{$gender}','{$mail}','{$mob}')";
			if($database->query($qry)){
				return true;
			}else{
				return false;
			}
			
		}
	}
?>