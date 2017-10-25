<?php 
	include 'inc/header.php';
	error_reporting(0);
?>
<?php 
	if (isset($_GET['dt'])) {
		$dt = $_GET['dt'];
	    $delmeal = "DELETE FROM tbl_meal WHERE date='$dt'";
	    $deldata = $user->db->deleteUser($delmeal);
	    if ($deldata) {
	        echo "<div class='alert alert-success'><strong>Success ! </strong> Meal Data Deleted successfully</div>";
	        header("Location: dailymeal.php");
		}else{
	         echo "<div class='alert alert-danger'><strong>Success ! </strong> Meal Data Can not be Deleted</div>";
        }
    }
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-success" href="currdaymeal.php">Count Today's Meal</a>
			<a class="btn btn-info pull-right" href="Home.php">Home</a>
		</h2>
	</div>
		<div class="panel-body">
			<form action="" method="post">
				<table class="table table-striped">
					<tr>
						<th width="25%">No</th>
						<th width="25%">Meal Date</th>
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
				$mealtime = $user->get_member_mealtime();
				if ($mealtime) {
					$i = 0;
					while ($value = $mealtime->fetch_assoc()) {
						$i++;
	 		?>		
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value['date']; ?></td>
						<td><a class="btn btn-primary" href="updatemeal.php?dt=<?php echo $value['date']; ?>">View</a>
						<a class="btn btn-primary" onclick="return confirm('Are you want to sure Delete?')" href="?dt=<?php echo $value['date']; ?>">Delete</a></td>
					</tr>
			<?php } } }?>
					<tr>
						<td><h4>Total Meal </h4></td>
			<?php 
				$totalmeal = $user->get_member_totalmeal($managerid);
				if ($totalmeal) {
					$ml = "";
					while ($result = $totalmeal->fetch_assoc()) {
						$ml=$ml+$result['meal'];
					} 
				}
			?>
						<td> <h4><?php if ($ml == "" OR $ml == NULL) { echo 0; }else{ echo $ml; } ?></h4> </td>
						<td></td>
					</tr>			
				</table>
			</form>
		</div>
<?php include 'inc/footer.php'; ?>