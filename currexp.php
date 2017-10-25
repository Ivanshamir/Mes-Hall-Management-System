<?php include 'inc/header.php'; ?>


<?php
	$cur_time = date("Y-m-d");

	 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$value = $user->addTodayExpense($cur_time, $_POST);
	 }
?>

<?php 
	if (isset($value)) {
		echo $value;
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
		<div class="well text-center" style="font-size: 25px;">
			<strong>Date : </strong><?php echo $cur_time; ?>
		</div>
		<div style="max-width: 600px;margin: 0 auto;">
		<form action="" method="post">
			<div class="form-group">
				<label for="expense">Today's Expense:</label>
				<input type="text" id="expense" name="expense" class="form-control" >
			</div>
			<div class="form-group">
				<input type="hidden" name="mng_id" class="form-control" value="<?php echo $managerid; ?>">
			</div>
			<input type="submit" name="submit" value="Save" class="btn btn-warning">
			</form>
		</div>
		
	</div>
</div>
	






<?php include 'inc/footer.php'; ?>