<?php include 'inc/header.php'; ?>

<?php
	if (!isset($_GET['dt']) || empty($_GET['dt'])) {
	 	echo "<script>window.location:'memdetail.php';</script>";
	 }else{
	 	$dt = $_GET['dt'];
	 } 

	  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	  	$updatemeal = $_POST['countmeal'];
		$dtmealdet = $user->dateMealDetails($dt, $updatemeal);
	 }
?>

<?php 
	if (isset($dtmealdet)) {
		echo $dtmealdet;
	}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-success" href="dailymeal.php">View Total Meal</a>
			<a class="btn btn-info pull-right" href="home.php">Back</a>
		</h2>
	</div>
		<div class="panel-body">
			<div class="well text-center" style="font-size: 25px;">
				<strong>Date : </strong><?php echo $dt; ?>
			</div>
			<form action="" method="post">
				<table class="table table-striped">
					<tr>
						<th width="25%">No</th>
						<th width="30%">Member Name</th>
						<th width="20%">Member Id</th>
						<th width="25%">Count Meal</th>
					</tr>
		<?php 
				$queryone = "SELECT db_member.name, tbl_meal.* FROM db_member
						INNER JOIN  tbl_meal
						ON db_member.memid = tbl_meal.memid 
						WHERE tbl_meal.date='$dt' ORDER BY memid";
				$value = $user->db->selectDb($queryone);
				if ($value) {
					$i=0;
					while ($result = $value->fetch_assoc()) {
						$i++;
				
		?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['name']; ?></td>
						<td><?php echo $result['memid'];?></td>
						<td>
							<input type="radio" name="countmeal[<?php echo $result['memid']; ?>]" value="0" <?php if($result['meal'] == '0'){ echo "checked";} ?>> 0 ||
							<input type="radio" name="countmeal[<?php echo $result['memid']; ?>]" value="1" <?php if($result['meal'] == '1'){ echo "checked";} ?>> 1 ||
							<input type="radio" name="countmeal[<?php echo $result['memid']; ?>]" value="2" <?php if($result['meal'] == '2'){ echo "checked";} ?>> 2 ||
							<input type="radio" name="countmeal[<?php echo $result['memid']; ?>]" value="3" <?php if($result['meal'] == '3'){ echo "checked";} ?>> 3 
						</td>
					</tr>
		<?php } } ?>
					<tr>
						<td colspan="4"><input class="btn btn-info" type="submit" name="submit" value="Update"></td>
					</tr>
				</table>
			</form>
		</div>
<?php include 'inc/footer.php'; ?>