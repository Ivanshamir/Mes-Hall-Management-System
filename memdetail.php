<?php
 include 'inc/header.php'; 
?>
<?php 
	error_reporting(0);
	$cur_time = date("Y-m-d");
	 if (isset($_GET['memdltid'])) {
        $memdltid = $_GET['memdltid'];
        $delmember = "DELETE FROM db_member WHERE memid='$memdltid'";
        $deldata = $user->db->deleteUser($delmember);
        if ($deldata) {
        	header("Location:memdetail.php");
            echo "<div class='alert alert-success'><strong>Success ! </strong> Member Data Deleted successfully</div>";
            
    	}else{
             echo "<div class='alert alert-danger'><strong>Success ! </strong> Member Data Can not be Deleted</div>";
        }
   }
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-success" href="addmember.php">Add Member</a>
			<a class="btn btn-info pull-right" href="home.php">Home</a>
		</h2>
	</div>
		<div class="panel-body">
			<div class="well text-center" style="font-size: 25px;">
				<strong>Date : </strong><?php echo $cur_time; ?>
				<button type="button" class="btn btn-warning pull-right" data-toggle="collapse" data-target="#demo">Caution</button>
				  <div id="demo" class="collapse">
				   When you remove any member details please also remove him data from givcash.php page. Otherwise application will generate wrong information.Thank you.
				  </div>
			</div>
			<form action="" method="post">
				<table class="table table-striped">

					<tr>
						<th width="15%">No</th>
						<th width="30%">Member Name</th>
						<th width="20%">Member Id No</th>
						<th width="35%" style="text-align: center;">Action</th>
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
				
						$memdetail = $user->member_details();
						if ($memdetail) {
							$i=0;
							while ( $result = $memdetail->fetch_assoc()) {
								$i++;
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['name']; ?></td>
						<td><?php echo $result['memid']; ?></td>
						<td style="text-align: center;">
							<a class="btn btn-primary" href="viewmember.php?memdtid=<?php echo $result['memid']; ?>">View</a> 
							<a class="btn btn-primary" href="editmember.php?memdtid=<?php echo $result['id']; ?>">Edit</a>
							<a class="btn btn-primary" onclick="return confirm('Are you want to sure Delete?')" href="?memdltid=<?php echo $result['memid']; ?>">Delete</a>
						</td>
					</tr>
			<?php } } } ?>		
				</table>
			</form>
		</div>

</div>
<?php include 'inc/footer.php'; ?>