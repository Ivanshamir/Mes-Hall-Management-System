<?php include 'inc/header.php'; ?>

<?php
	if (!isset($_GET['id']) || empty($_GET['id'])) {
	 	echo "<script>window.location='memdetail.php';</script>";
	 }else{
	 	$id = $_GET['id'];
	 } 
	 $dt = date("Y-m-d");
	  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$updatecash = $user->updateCashMember($dt, $_POST, $id);
	 }

?>

<?php 
	if (isset($updatecash)) {
		echo $updatecash;
	}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-success" href="totalexp.php">Total Expenses</a>
			<a class="btn btn-info pull-right" href="home.php">Home</a>
		</h2>
	</div>

	<div class="panel-body">
		<div style="max-width: 600px;margin: 0 auto;">
		<form action="" method="post">
			<div class="form-group">
				<label for="expense">Today's New Expense:</label>
				<input type="text" id="expense" name="expense" class="form-control" >
			</div>
			<input type="submit" name="submit" value="Update" class="btn btn-info">
			</form>
		</div>
		
	</div>
</div>
	






<?php include 'inc/footer.php'; ?>