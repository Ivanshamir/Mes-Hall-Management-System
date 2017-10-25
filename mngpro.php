<?php include 'inc/header.php'; ?>

<?php 
	$managerid = Session::get("mng_id");
	$name = Session::get("name");
	$username = Session::get("username");
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
			$mngrupreg = $user->ManagerUpdateRegistration($managerid,$_POST);
	}
?>

<?php
	if (isset($mngrupreg)) {
		echo $mngrupreg;
	}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			Mes manager profile
			<a class="btn btn-info pull-right" href="home.php">Back</a>
		</h2>
	</div>
	<div class="panel-body">
		<div style="max-width: 600px;margin: 0 auto;">
		<form action="" method="post">
			<div class="form-group">
		<?php 
			$query = "SELECT * FROM tbl_manager WHERE mng_id='$managerid'";
			$rst = $user->db->selectDb($query);
			if ($rst == true) {
				$result = $rst->fetch_assoc();
					
		?>
				<label for="name">Name:</label>
				<input type="text" id="name" name="name" class="form-control" value="<?php echo $result['name']; ?>" >
			</div>
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" id="username" name="username" class="form-control" value="<?php echo $result['username']; ?>">
			</div>
		
			<input type="submit" name="update" value="Update" class="btn btn-primary">
			<a class="btn btn-warning" href="changepass.php?passid=<?php echo $result['mng_id']; ?>">Change Password</a>
		<?php } ?>
			</form>
		</div>
		
	</div>
</div>
	






<?php include 'inc/footer.php'; ?>