<?php 
	include 'lib/user.php';
	$user = new User();
?>
<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
			$mngrReg = $user->ManagerRegistration($_POST);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mes Management system</title>
	<link rel="stylesheet" href="inc/bootstrap.min.css">
	<script src="inc/jquery.min.js"></script>
	<script src="inc/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="well" style="height: 80px">
			
		</div>
<?php
	if (isset($mngrReg)) {
		echo $mngrReg;
	}
?>
	<div class="panel panel-default">

	<div class="panel-heading">
		<h2>
			Mes manager register
			<a class="btn btn-info pull-right" href="login.php">Login</a>
		</h2>
	</div>
	<div class="panel-body">
		<div style="max-width: 600px;margin: 0 auto;">
		<form action="" method="post">
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" id="name" name="name" class="form-control" >
			</div>
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" id="username" name="username" class="form-control" >
			</div>
			<div class="form-group">
				<label for="mng_id">Manager Id:</label>
				<input type="text" id="mng_id" name="mng_id" class="form-control" >
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" class="form-control">
			</div>
			<input type="submit" name="register" value="Register" class="btn btn-primary">
			</form>
		</div>
		
	</div>
</div>
	






<?php include 'inc/footer.php'; ?>