<?php include 'inc/header.php'; ?>

<?php 
	error_reporting(0);
	$cur_time = date("Y-m-d");

	if (isset($_GET['action']) && $_GET['action'] == 'remove') {
		$tables = array("tbl_expense","tbl_meal","tbl_givcash");
		foreach ($tables as $table) {
		$deldata = "DELETE FROM  $table WHERE mng_id='$managerid'";
		$result = $user->db->deleteUser($deldata);
		}
		if ($result) {
            echo "<div class='alert alert-success'><strong>Success ! </strong> Member Data Deleted successfully</div>";
           header("Location: totalexp.php");
    	}else{
             echo "<div class='alert alert-danger'><strong>Success ! </strong> Member Data Can not be Deleted</div>";
        }
	}
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-success" href="currexp.php">Add Current day expenses</a>
			<a class="btn btn-info pull-right" href="home.php">Back</a>
		</h2>
	</div>
		<div class="panel-body">
			<div class="well text-center" style="font-size: 25px;">
				<strong>Date : </strong><?php echo $cur_time; ?>
			</div>
				<table class="table table-striped">
					<tr>
						<th width="25%">No</th>
						<th width="25%">Date</th>
						<th width="25%">Expenses</th>
						<th width="25%">Action</th>
					</tr>
				<?php 
					$queryone = "SELECT mng_id FROM db_member";
					$resultone = $user->db->selectDb($queryone);
					if ($resultone) {
						while ($prstmngid = $resultone->fetch_assoc()) {
							$mngrid = $prstmngid['mng_id'];
						}
					}
					if ($managerid == $mngrid) {

					$totexp = $user->totalExpenses();
					if ($totexp) {
						$i=0;
						while ($result = $totexp->fetch_assoc()) {
							$i++;
				?>

					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['date']; ?></td>
						<td><?php echo $result['expense']; ?></td>
						<td><a class="btn btn-primary" href="updateexp.php?id=<?php echo $result['id']; ?>">Update expenses</a></td>
					</tr>
				<?php } } }?>	
					<tr>
						<td><h3>Total expenses</h3></td>
				<?php 
					$totaltk = $user->totalExpensesinTk($managerid);
					if ($totaltk) {
						$tk="";
						while ($result = $totaltk->fetch_assoc()) {
							$tk=$result['expense']+$tk;
					 	}
					 }
				?>
						<td><h3><?php if ($tk == "" OR $tk == NULL) { echo 0; }else{echo $tk; }?></h3></td>
						<td><h3>Meal Rate</h3></td>
				<?php
					$tm = $user->get_member_totalmeal($managerid);
						if ($tm) {
							$totalmeal = "";
							while ($tmr = $tm->fetch_assoc()) {
								$totalmeal=$totalmeal+$tmr['meal'];
							} 
						}
						$mealrate =round($tk/$totalmeal, 4);
				?>
						<td><h3><?php if ($mealrate == "" OR $mealrate == NULL) { echo 0; }else{echo $mealrate;} ?></h3></td>
					</tr>
				</table>
			</form>
			<a class="btn btn-primary" onclick="return confirm('Are you want to sure Delete?')" href="?action=remove">Remove all data</a>
		</div>
<?php include 'inc/footer.php'; ?>