<?php 
	include 'lib/Session.php';
	Session::checkSession();
?>
<?php 
	include 'lib/user.php';
	$user = new User();
	$managerid = Session::get("mng_id");

	
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
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