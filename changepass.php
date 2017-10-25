<?php include 'inc/header.php'; ?>

<?php 
	if (!isset($_GET['passid']) || empty($_GET['passid'])) {
	 	echo "<script>window.location='home.php';</script>";
	 }else{
	 	$passid = $_GET['passid'];
	 } 
	 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
		$updpass = $user->updateMemberPassword($passid, $_POST);
	 }
?>

<?php 
	if (isset($updpass)) {
		echo $updpass;
	}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-info" href="mngpro.php">Profile</a>
			<a class="btn btn-info pull-right" href="home.php">Home</a>
		</h2>
	</div>
	<div class="panel-body">
		<div style="max-width: 600px;margin: 0 auto;">
		<form action="" method="post">
			<div class="form-group">
				<label for="oldpass">Old password:</label>
				<input type="password" name="oldpass" class="form-control" />
			</div>
			<div class="form-group">
				<label for="newpass">New Password:</label>
				<input type="password" name="newpass" class="form-control">
			</div>
			<input type="submit" name="update" value="Change Password" class="btn btn-primary">
			</form>
		</div>
		
	</div>
</div>
	






<?php include 'inc/footer.php'; ?>