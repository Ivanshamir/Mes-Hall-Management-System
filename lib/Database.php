<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/../config/Config.php';
?>

<?php 
	class Database{
		public $host = DB_HOST;
		public $user = DB_USER;
		public $pass = DB_PASS;
		public $dbname = DB_NAME;

		public $link;
		public $error;

		public function __construct()
		{
			$this->connectDb();
		}
		private function connectDb(){
			$this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			if(!$this->link){
				$this->error = "Database connection error".$this->link->connect_error;
				return false;
			}
		}
		//select from database
		public function selectDb($query){
			$result = $this->link->query($query) or die($this->link->error.__LINE__);
			if($result->num_rows > 0){
				return $result;
			}else{
				return false;
			}
		}
		//insert to database
		public function dbCreate($query){
			$result = $this->link->query($query) or die($this->link->error.__LINE__);
			if($result){
				return $result;
			}else{
				return false;
			}
		}
		//update to database
		public function dbUpdate($query){
			$result = $this->link->query($query) or die($this->link->error.__LINE__);
			if($result){
				return $result;
			}else{
				return false;
			}
		}
		//delete datatable
		public function deleteUser($query){
			$result = $this->link->query($query) or die($this->link->error.__LINE__);
			if($result){
				return $result;
			}else{
				return false;
			}
		}
	}

?>