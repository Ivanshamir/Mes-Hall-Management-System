<?php
 include 'lib/Session.php';
  Session::checkLogin();
  include 'lib/user.php';
  $user = new User();
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
		<?php 
                if (isset($_GET['action']) && $_GET['action'] == "logout") {
                    Session::Destroy();
                }
            ?>
		<div class="well" style="height: 80px">
			<a  href="?action=logout" class="btn btn-primary pull-right">Logout</a>
		</div>
<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $user->validation($_POST['username']);
		$password = $user->validation(md5($_POST['password']));

		$username = mysqli_real_escape_string($user->db->link, $username);
		$password = mysqli_real_escape_string($user->db->link, $password);

		$query = "SELECT * FROM tbl_manager WHERE username='$username' AND password='$password'";
		$result = $user->db->selectDb($query);
		if ($result != false) {
				$value = $result->fetch_assoc();
					Session::set("login", true);
					Session::set("name", $value['name']);
					Session::set("username", $value['username']);
					Session::set("mng_id", $value['mng_id']);
					header("Location: home.php");
				}else{
				echo "<div class='alert alert-danger'><strong>Error ! </strong> Manager Name and Manager Password can not be matched</div>";
				}
	
	}
?>
	<div class="panel panel-default">
			<div class="panel-heading">
				<h2>
					<a class="btn btn-info " href="index.php">Back</a>
				</h2>
			</div>

			<div class="panel-body" style="width: 800px;margin: 0 auto;">
				<form action="" method="post">
					<div class="form-group">
						<label for="name">Manager User Name:</label>
						<input class="form-control" type="text" name="username" id="username">
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input type="password" id="password" name="password" class="form-control">
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit" name="submit" value="Submit">
					</div>
				</form>
			</div>
	</div>



<?php include 'inc/footer.php'; ?>