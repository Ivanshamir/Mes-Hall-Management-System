<?php
 include 'inc/header.php'; 
 $cur_time = date("Y-m-d");
 $usrname = Session::get("username");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h2 style="color:#966464;">
			Welcome ! <strong><?php echo $usrname; ?> </strong>
		</h2>
	</div>
	<div class="panel-body">
		<div class="well text-center" style="font-size: 25px;">
			<strong>Date : </strong><?php echo $cur_time; ?>
		</div>
		<div style="max-width: 600px;margin: 0 auto;">
				<div class="panel-body text-center">
			     	 <a class="btn btn-warning btn-block" href="mngpro.php" style="font-weight: bold;">Manager Profile</a> <br>
			     	 <a class="btn btn-primary btn-block" href="addmember.php" style="font-weight: bold;">Add Member</a> <br>
			     	 <a class="btn btn-success btn-block" href="memdetail.php" style="font-weight: bold;">Member Details</a> <br>
			     	 <a class="btn btn-danger btn-block" href="givcash.php" style="font-weight: bold;">View given cash from members</a> <br>
			     	 <a class="btn btn-info btn-block" href="totalexp.php" style="font-weight: bold;">View total expenses in current month</a> <br>
			     	 <a class="btn btn-warning btn-block" href="currexp.php" style="font-weight: bold;">Add Current Day expenses</a> <br>
			     	  <a class="btn btn-danger btn-block" href="currdaymeal.php" style="font-weight: bold;">Count today's meal</a> <br>
			     	 <a class="btn btn-success btn-block" href="dailymeal.php" style="font-weight: bold;">View daily meal catalog</a>
			      </div>
			</div>
		</div>
		
</div>

	






<?php include 'inc/footer.php'; ?>