<?php
	require_once("config.php");
	
	class MysqlDatabase{
		private $connection;
		
		function __construct(){
			$this->open_connection();
		}
		public function open_connection(){
			$this->connection=mysql_connect(DB_SERVER,DB_USER,DB_PASS);
			if(!$this->connection){
				echo "Database connection failed: ".mysql_error();
			}
			else{
				$db_select=mysql_select_db(DB_NAME,$this->connection);
				if(!$db_select){
					echo "Database selection failed: ".mysql_error();
				}
			}
		}
		public function close_connection(){
			if(isset($this->connection)){
				mysql_close($this->connection);
				unset($this->connection);
			}
		}
		public function query($qry){
			$result=mysql_query($qry,$this->connection);
			$this->confirm_query($result);
			return $result;
		}
		private function confirm_query($result){
			if(!$result){
				//echo "Database query failed: ".mysql_error();
			}
		}
		public function fetch_array($result_set){
			return mysql_fetch_array($result_set);
		}
		
		public function num_rows($result_set){
			return mysql_num_rows($result_set);
		}
		public function insert_id(){
			//get last id inserted into database
			return mysql_insert_id($this->connection);
		}
		public function affected_rows(){
			return mysql_affected_rows($this->connection);
		}
	}
	
	$database=new MysqlDatabase();
?>