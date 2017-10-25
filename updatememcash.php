<?php 
 include 'inc/header.php'; 
?>


<?php
	$cur_time = date("Y-m-d");
	if (!isset($_GET['edmemid']) || empty($_GET['edmemid'])) {
	 	echo "<script>window.location:'memdetail.php';</script>";
	 }else{
	 	$edmemid = $_GET['edmemid'];
	 } 


	 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$upcash = $user->updateCashfromMember($cur_time, $_POST);
	 }
?>

<?php 
	if (isset($upcash)) {
		echo $upcash;
	}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-success" href="givcash.php">Total Amount of cash</a>
			<a class="btn btn-info pull-right" href="home.php">Home</a>
		</h2>
	</div>

	<div class="panel-body">
		<div class="well text-center" style="font-size: 25px;">
			<strong>Date : </strong><?php echo $cur_time; ?>
		</div>
		<div style="max-width: 600px;margin: 0 auto;">
		<form action="" method="post">
			<div class="form-group">
				<label for="givencash">New given cash:</label>
				<input type="text" id="givencash" name="givencash" class="form-control" >
			</div>
			<div class="form-group">
				<input type="hidden" id="memid" name="memid" class="form-control" value="<?php echo $edmemid; ?>">
			</div>
			<input type="submit" name="submit" value="Update" class="btn btn-primary">
			</form>
		</div>
		
	</div>
</div>
	






<?php include 'inc/footer.php'; ?>