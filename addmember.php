<?php
 include 'inc/header.php';
?>

<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = $_POST['name'];
		$memberid = $_POST['memberid'];
		$addmem = $user->addMember($name, $memberid, $managerid);
	}
?>

<?php 
	if (isset($addmem)) {
		echo $addmem;
	}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-warning" href="memdetail.php">Member Details</a>
			<a class="btn btn-info pull-right" href="home.php">Back</a>
		</h2>
	</div>

	<div class="panel-body">
		<div style="max-width: 600px;margin: 0 auto;">
		<form action="" method="post">
			<div class="form-group">
				<label for="name">Member Name:</label>
				<input type="text" id="name" name="name" class="form-control" >
			</div>
			<div class="form-group">
				<label for="memberid">Member Id No:</label>
				<input type="text" id="memberid" name="memberid" class="form-control">
			</div>
			<div class="form-group">
				<input type="hidden" name="mng_id" class="form-control" value="<?php echo $managerid; ?>">
			</div>
			<input type="submit" name="submit" value="Save" class="btn btn-info">
		</form>
		</div>
		
	</div>
</div>
	






<?php include 'inc/footer.php'; ?>