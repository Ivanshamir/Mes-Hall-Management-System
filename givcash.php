<?php 
	include 'inc/header.php'; 
?>
<?php
	error_reporting(0);
	$cur_time = date("Y-m-d");
	 if (isset($_GET['cashdltid'])) {
        $cashdltid = $_GET['cashdltid'];
        $delmember = "DELETE FROM tbl_givcash WHERE memid='$cashdltid'";
        $deldata = $user->db->deleteUser($delmember);
      	$delmeal = "DELETE FROM tbl_meal WHERE memid='$cashdltid'";
        $deldata = $user->db->deleteUser($delmeal);
        if ($deldata) {
            echo "<div class='alert alert-success'><strong>Success ! </strong> Member Data Deleted successfully</div>";
             header("Location: givcash.php");
    	}else{
             echo "<div class='alert alert-danger'><strong>Success ! </strong> Member Data Can not be Deleted</div>";
        }
     }
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-success" href="totalexp.php">Show expenses</a>
			<a class="btn btn-info pull-right" href="memdetail.php">Member Details</a>
		</h2>
	</div>
		<div class="panel-body">
			<div class="well text-center" style="font-size: 25px;">
				<strong>Date : </strong><?php echo $cur_time; ?>
			</div>
			<form action="" method="post">
				<table class="table table-striped">
		
					<tr>
						<th width="10%">No</th>
						<th width="40%">Member Name</th>
						<th width="20%">Given Cash</th>
						<th width="10%">Member Id</th>
						<th width="20%">Action</th>
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
				$memdetail = $user->view_membercash();
				if ($memdetail) {
					$i=0;
					while ($result = $memdetail->fetch_assoc()) {
						$i++;
			?> 
			
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['name']; ?></td>
						<td><?php echo $result['givencash']; ?></td>
						<td><?php echo $result['memid']; ?></td>
						<td>
							<a class="btn btn-primary" href="updatememcash.php?edmemid=<?php echo $result['memid']; ?>" style="width: 60%;">Update cash</a> 
							<a class="btn btn-primary" onclick="return confirm('Are you want to sure Delete?')" href="?cashdltid=<?php echo $result['memid']; ?>">Delete</a>
						</td>
					</tr>

			<?php } } } ?>		
					<tr>
						<td></td>
						<td><h4>Total Cash</h4></td>
			<?php 
				$total = $user->totalamount($managerid);
				if ($total) {
					$tk = "";
					while ($ttal = $total->fetch_assoc()) {
						$tk = $tk + $ttal['givencash'];
				} } 
			?> 
						<td><h4><?php 
							if ($tk == "" OR $tk == NULL) {
								echo 0;
							}else{
								echo $tk;
							}
						?></h4></td>
						<td></td>
						<td></td>
					</tr>
				</table>
			</form>
		</div>

</div>
<?php include 'inc/footer.php'; ?>