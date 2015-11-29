<?php
	require_once("database_class.php");
	class Photograph{
		private static $table_name="tblimages";
		private static $db_fields=array('id','file_name','type','size','caption');
		public $id;
		public $file_name;
		public $type;
		public $size;
		public $caption;
		public $cat_id;
		private $temp_path;
		private $upload_dir="images";
		public $errors=array();
		private $upload_errors=array(
			UPLOAD_ERR_OK		  => "No Errors.",
			UPLOAD_ERR_INI_SIZE	  => "Maximum Size.",
			//UPLOAD_ERR_FROM_SIZE  => "Maximum Size.",
			UPLOAD_ERR_PARTIAL	  => "Partial Upload.",
			UPLOAD_ERR_NO_FILE	  => "No File.",
			UPLOAD_ERR_NO_TMP_DIR => "No Temporary Directory.",
			UPLOAD_ERR_CANT_WRITE => "Can't write to the Disk.",
			UPLOAD_ERR_EXTENSION  => "File upload stopped by extension."
		);
		public function save(){
			if(isset($this->id)){//updating database
				$this->update();
			}else{
				if(!empty($this->errors)){return false;}
				if(strlen($this->caption)>=255){
					$this->errors[]="The caption can only be 255 characters long.";
					return false;
				}
				$target_path=SITE_ROOT.DS.'public'.DS.$this->upload_dir.DS.$this->file_name;
				if(file_exists($target_path)){
					$this->errors[]="The file {$this->file_name} already exists.";
					return false;
				}
				if(move_uploaded_file($this->temp_path,$target_path)){
					if($this->create()){
						unset($this->temp_path);
						return true;
					}
				}else{
					$this->errors[]="File upload failed";
					return false;
				}
			}
		}
		public function attach_file($file){
			//perform error checking
			if(!$file || empty($file) || !is_array($file)){
				$this->errors[]="No file was uploaded.";
				return false;
			}elseif($file['error']!=0){
				$this->errors[]=$this->upload_errors[$file['error']];
				return false;
			}else{
				$this->temp_path=$file["tmp_name"];
				$this->file_name=basename($file['name']);
				$this->type=$file["type"];
				$this->size=$file['size'];
				return true;
			}
		}
		
		public function image_path(){
			return $this->upload_dir.'/'.$this->file_name;
		}
		
		public static function find_all(){
			$qry="select * from tblimages";
			return self::find_by_sql($qry);
		}
		
		public static function find_by_sql($sql="") {
    		global $database;
    		$result_set = $database->query($sql);
		    $object_array = array();
		    while ($row = $database->fetch_array($result_set)) {
	      		$object_array[] = self::instantiate($row);
    		}
    		return $object_array;
  		}
		
		public static function count_all(){
			global $database;
			$qry="select COUNT(*) from tblimages";
    		$result_set = $database->query($qry);
			$row = $database->fetch_array($result_set);
			return array_shift($row);
		}
		
		private static function instantiate($record) {
			// Could check that $record exists and is an array
	    	$object = new self;
			// More dynamic, short-form approach:
			foreach($record as $attribute=>$value){
		 	 if($object->has_attribute($attribute)) {
		    	$object->$attribute = $value;
		 	 }
			}	
			return $object;
		}
	
		private function has_attribute($attribute) {
	  	// We don't care about the value, we just want to know if the key exists
	 	 // Will return true or false
	 	 return array_key_exists($attribute, $this->attributes());
		}
		
		protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(self::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
		
		
		public function create(){
			global $database;
			$qry="insert into tblimages (file_name,type,size,caption,cat_id) values('{$this->file_name}','{$this->type}',
			      '{$this->size}','{$this->caption}','{$this->cat_id}')";
			if($database->query($qry)){
				$this->id=$database->insert_id();
				return true;
			}else{
				return false;
			}
			
		}
		public function delete(){
			global $database;
			$qry="delete from tblimages where id={$this->id}";
			if($database->query($qry)){
				return true;
			}else{
				return false;
			}
		}
		public function update(){
			global $database;
			$qry="UPDATE tblimages SET caption='{$this->caption}' WHERE id={$this->id}";
			if($database->query($qry)){
				return true;
			}else{
				return false;
			}
		}
	}
?>
