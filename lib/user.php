<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/Database.php';
?>

<?php

	class User{
		
		public $db;

		public function __construct(){
			$this->db =  new Database();
		}
	
		public function addMember($name, $memberid, $managerid){
			$name = mysqli_real_escape_string($this->db->link, $name);
			$memberid = mysqli_real_escape_string($this->db->link, $memberid);
			$memid = $this->checkMemberid($memberid);

			if($name == "" OR $memberid == ""){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
				return $msg;
			}
			if(strlen($name)<3){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Membername is too short</div>";
				return $msg;
			}elseif (preg_match('/[^a-z0-9_ -]+/i', $name)) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Member only contains alphanumeric, dashes, underscores and whitespaces!</div>";
				return $msg;
			}
			if ($memid == true) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Memberid is already exist!</div>";
				return $msg;
			}
			$query = "INSERT INTO db_member(name, memid, mng_id) VALUES('$name','$memberid','$managerid')";
			$result = $this->db->dbCreate($query);  
			$query = "INSERT INTO tbl_givcash(memid, mng_id) VALUES('$memberid','$managerid')";
			$result = $this->db->dbCreate($query);
			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success ! </strong> Member Data inserted successfully</div>";
					return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong> Member Data can not be inserted</div>";
					return $msg;
			}

		}

		public function checkMemberid($memberid){
			$sql = "SELECT memid FROM db_member WHERE memid='$memberid' LIMIT 1";
			$result = $this->db->selectDb($sql);
			if ($result) {
				return true;
			}else{
				return false;
			}
		}

		public function member_details(){
			$query = "SELECT * FROM db_member ORDER BY memid";
			$result = $this->db->selectDb($query);
			return $result;		
		}

		public function edit_member($memdtid){
			$query = "SELECT * FROM db_member WHERE id='$memdtid'";
			$result = $this->db->selectDb($query);
			return $result;	
		}

		
		public function updateMember($memdtid, $data){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);

			if($name == ""){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
				return $msg;
			}
			if(strlen($name)<3){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Membername is too short</div>";
				return $msg;
			}elseif (preg_match('/[^a-z0-9_ -]+/i', $name)) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Member only contains alphanumeric, dashes, underscores and whitespaces!</div>";
				return $msg;
			}

			$query = "UPDATE db_member SET 
				  name='$name'
				  WHERE id='$memdtid'";
			$result = $this->db->dbUpdate($query);
			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success ! </strong> Member Data updated successfully</div>";
					return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong> Member Data can not be updated</div>";
					return $msg;
			}
			
		}

		public function view_membercash(){
			$query = "SELECT db_member.*, tbl_givcash.givencash 
						FROM db_member
						INNER JOIN tbl_givcash
						ON db_member.memid = tbl_givcash.memid
						ORDER BY memid";
			$result = $this->db->selectDb($query);
			return $result;	
		}	

		public function addCashMember($givencash, $edmemid){
			if($givencash == ""){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
				return $msg;
			}
			$query = "INSERT INTO tbl_givcash(givencash, date) 
					 VALUES('$givencash', now()) 
					 WHERE id='$edmemid'";
			$result = $this->db->dbCreate($query);
			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success ! </strong> Member's Given Cash inserted successfully</div>";
					return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong> Member's Given Cash can not be inserted</div>";
					return $msg;
			}

		}

		public function updateCashfromMember($cur_time, $data){
			$givencash = mysqli_real_escape_string($this->db->link, $data['givencash']);
			$edmemid = $data['memid'];
			if($givencash == ""){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
				return $msg;
			}
			$query = "UPDATE tbl_givcash 
					  SET givencash=givencash+'$givencash',
					  date='$cur_time'
					 WHERE memid='$edmemid'";
			$result = $this->db->dbUpdate($query);
			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success ! </strong> Member's Given Cash updated successfully</div>";
					return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong> Member's Given Cash can not be updated</div>";
					return $msg;
			}
		}



		
		public function totalamount($managerid){
			$query = "SELECT givencash FROM tbl_givcash WHERE mng_id='$managerid'";
			$result = $this->db->selectDb($query);
			return $result;	
		}

		public function totalExpenses(){
			$query = "SELECT * FROM tbl_expense ORDER BY date";
			$result = $this->db->selectDb($query);
			return $result;	
		}

		public function totalExpensesinTk($managerid){
			$query = "SELECT expense FROM tbl_expense WHERE mng_id='$managerid'";
			$result = $this->db->selectDb($query);
			return $result;	
		}
		

		public function addTodayExpense($cur_time, $data){
			$expense = mysqli_real_escape_string($this->db->link, $data['expense']);
			$mng_id = $data['mng_id'];
			if($expense == ""){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
				return $msg;
			}
			$query = "INSERT INTO tbl_expense(expense, date, mng_id) VALUES('$expense','$cur_time','$mng_id')";
			$result = $this->db->dbCreate($query);  
			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success ! </strong> Member Data inserted successfully</div>";
					return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong> Member Data can not be inserted</div>";
					return $msg;
			}
		}

		public function updateCashMember($dt, $data, $id){
			$expense = mysqli_real_escape_string($this->db->link, $data['expense']);
			if($expense == ""){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
				return $msg;
			}
			$query = "UPDATE tbl_expense 
					  SET expense=expense+'$expense',
					  	  date='$dt'
					 WHERE id='$id'";
			$result = $this->db->dbUpdate($query);
			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success ! </strong> Expenses Data updated successfully</div>";
					return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong> Expenses Data can not be updated</div>";
					return $msg;
			}

		}


		public function countMemberMeal($cur_time, $countmeal = array(), $managerid){

			$sql_meal = "SELECT DISTINCT date FROM tbl_meal";


			$atten_meal = $this->db->selectDb($sql_meal);
			if ($atten_meal) {
				while ($mealresult = $atten_meal->fetch_assoc()) {
				$db_date = $mealresult['date'];
				if ($cur_time == $db_date) {
					$msg = "<div class='alert alert-danger'><strong>Error ! </strong> Member Meal Data already taken!</div>";
					return $msg;
				}
			  }
			}
			


			foreach ($countmeal as $meal_key => $meal_value) {
				$query = "INSERT INTO tbl_meal(memid, meal, date, mng_id) VALUES('$meal_key','$meal_value', now(),'$managerid' )";
				$result = $this->db->dbCreate($query);  
			}
			
			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success ! </strong> Meal Data inserted successfully</div>";
					return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong> Meal Data can not be inserted</div>";
					return $msg;
			}
		}

		public function get_member_mealtime(){
			$mealtime = "SELECT DISTINCT date FROM tbl_meal";
			$totalmeal = $this->db->selectDb($mealtime);
			return $totalmeal;
		}

		public function get_member_totalmeal($managerid){
			$totalml = "SELECT meal FROM tbl_meal WHERE mng_id='$managerid'";
			$result = $this->db->selectDb($totalml);
			return $result;
		}

		public function dateMealDetails($dt, $updatemeal = array()){
			foreach ($updatemeal as $upmeal_key => $upmeal_value) {
			$query = " UPDATE tbl_meal
						SET meal='$upmeal_value'
						WHERE memid = '".$upmeal_key."' AND date = '".$dt."'  ";
			$result = $this->db->dbUpdate($query);
			}
			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success ! </strong> Meal Data updated successfully</div>";
					return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error ! </strong> Meal Data can not be updated</div>";
					return $msg;
			}
		}


		public function ManagerRegistration($data){
			$name = $this->validation($data['name']);
			$username = $this->validation($data['username']);
			$mng_id = $this->validation($data['mng_id']);
			$password = $this->validation($data['password']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$username = mysqli_real_escape_string($this->db->link, $username);
			$mng_id = mysqli_real_escape_string($this->db->link, $mng_id);
			$password = mysqli_real_escape_string($this->db->link, $password);
			$managerid = $this->checkManagerid($mng_id);

			if($name == "" OR $username == "" OR $mng_id == "" OR $password == ""){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
				return $msg;
			}
			if(strlen($name)<3){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Membername is too short</div>";
				return $msg;
			}elseif (preg_match('/[^a-z0-9_ -]+/i', $name)) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Membername only contains alphanumeric, dashes, underscores and whitespaces!</div>";
				return $msg;
			}

			if(strlen($username)<3){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Username is too short</div>";
				return $msg;
			}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Username only contains alphanumeric, dashes and underscores!</div>";
				return $msg;
			}
			if ($managerid == true) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Managerid is already exist!</div>";
				return $msg;
			}

			$password = md5($data['password']);
			$query = "INSERT INTO tbl_manager(name, username, mng_id, password) VALUES('$name', '$username', '$mng_id', '$password')";
			$mngresult = $this->db->dbCreate($query);	
			if($mngresult){
				$msg = "<div class='alert alert-success'><strong>Success!</strong>Thank You, you have been registered</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Sorry you cant registered.</div>";
				return $msg;
			}
		}


		 public function validation($data){
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		public function checkManagerid($mng_id){
			$sql = "SELECT mng_id FROM tbl_manager WHERE mng_id='$mng_id' LIMIT 1";
			$result = $this->db->selectDb($sql);
			if ($result) {
				return true;
			}else{
				return false;
			}
		}


		public function ManagerUpdateRegistration($managerid,$data){
			$name = $this->validation($data['name']);
			$username = $this->validation($data['username']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$username = mysqli_real_escape_string($this->db->link, $username);

			if($name == "" OR $username == ""){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
				return $msg;
			}
			if(strlen($name)<3){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Membername is too short</div>";
				return $msg;
			}elseif (preg_match('/[^a-z0-9_ -]+/i', $name)) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Membername only contains alphanumeric, dashes, underscores and whitespaces!</div>";
				return $msg;
			}

			if(strlen($username)<3){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Username is too short</div>";
				return $msg;
			}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Username only contains alphanumeric, dashes and underscores!</div>";
				return $msg;
			}
			$query = "UPDATE  tbl_manager
						SET name='$name',
						username='$username'
						WHERE mng_id='$managerid'";
			$mngresult = $this->db->dbUpdate($query);	
			if($mngresult){
				$msg = "<div class='alert alert-success'><strong>Success!</strong>Your data have been updated!</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>You can't update your data!</div>";
				return $msg;
			}
		}

		public function checkpassword($id , $oldpass){
			$password = md5($oldpass);
			$querypass = "SELECT password FROM tbl_manager WHERE mng_id='$id' AND password='$password'";
			$qurst = $this->db->selectDb($querypass);
			if ($qurst) {
				return true;
			}else{
				return false;
			}
		}

		public function updateMemberPassword($passid, $data){
			$oldpass = $data['oldpass'];
			$newpass = $data['newpass'];
			$id = $passid;
			if($oldpass == "" OR $newpass == ""){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Password cant be empty.</div>";
				return $msg;
			}
			$chk_pass = $this->checkpassword($id , $oldpass);
			if ($chk_pass == false) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Password not exist.</div>";
				return $msg;
			}

			$password = md5($newpass);
			$query = "UPDATE tbl_manager
						SET password='$password'
						WHERE mng_id='$passid'";
			$mngresult = $this->db->dbUpdate($query);	
			if($mngresult){
				$msg = "<div class='alert alert-success'><strong>Success!</strong>Your password have been updated!</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>You can't update your password!</div>";
				return $msg;
			}
		}

	}
 ?>