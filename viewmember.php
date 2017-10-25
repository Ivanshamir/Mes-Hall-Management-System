<?php include 'inc/header.php'; ?>


<?php
	$managerid = Session::get("mng_id");
	error_reporting(0);
	$cur_time = date("Y-m-d");
	if (!isset($_GET['memdtid']) || empty($_GET['memdtid'])) {
	 	echo "<script>window.location:'memdetail.php';</script>";
	 }else{
	 	$memdtid = $_GET['memdtid'];
	 } 
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-info " href="home.php">Home</a>
			<a class="btn btn-success pull-right" href="memdetail.php">Back</a>
		</h2>
	</div>
		<div class="panel-body">
			<div class="well text-center" style="font-size: 25px;">
				<strong>Date : </strong><?php echo $cur_time; ?>
			</div>
				<table class="table table-striped">
					
					<tr>
						<td>Member's Name:</td>
				<?php
					$membername = "SELECT name FROM db_member WHERE memid='$memdtid'";
					$memnamerst = $user->db->selectDb($membername); 
					if ($memnamerst) {
						while ($namevalue = $memnamerst->fetch_assoc()) {
				?>
						<td><?php echo $namevalue['name']; ?></td>
				<?php } } ?>
					</tr>

					<tr>
						<td>Total meal</td>
				<?php
					$membermeal = "SELECT meal FROM tbl_meal WHERE memid='$memdtid'";
					$memmealrst = $user->db->selectDb($membermeal); 
					if ($memmealrst) {
						$tm=0;
						while ($namevalue = $memmealrst->fetch_assoc()) {
							$tm = $tm+$namevalue['meal'];
						}
					}
				?>
						<td>
							<?php 
								if ($tm == "" || $tm == 0 || $tm == NULL) {
									echo 0;
								}else{
									echo $tm; 
								}
								
							?>
						</td>
				
					</tr>

					<tr>
						<td>Given amount of money</td>
				<?php
					$givenmoney = "SELECT givencash FROM tbl_givcash WHERE memid='$memdtid'";
					$memgivmon = $user->db->selectDb($givenmoney); 
					if ($memgivmon) {
						while ($givmon = $memgivmon->fetch_assoc()) {
							$persongivencash = $givmon['givencash'];
				?>
						<td><?php echo $persongivencash; ?></td>
				<?php } } ?>
					</tr>
				<?php
					$totalml = "SELECT meal FROM tbl_meal WHERE mng_id='$managerid'";
					$totm = $user->db->selectDb($totalml);
					if ($totm) {
						$totalmeal = 0;
						while ($tmr = $totm->fetch_assoc()) {
							$totalmeal=$totalmeal+$tmr['meal'];
						} 
					}

					$queryone = "SELECT expense FROM tbl_expense WHERE mng_id='$managerid'";
					$totaltk = $user->db->selectDb($queryone);
					if ($totaltk) {
						$totalexp=0;
						while ($result = $totaltk->fetch_assoc()) {
							$totalexp=$result['expense']+$totalexp;
					 	}
					 }
					 $mealrate =round($totalexp/$totalmeal, 4);
					 $persontk =round($tm*$mealrate, 0, PHP_ROUND_HALF_UP); ?>

					 
					<?php if($persontk>$persongivencash){
					 	$duemoney = $persontk-$persongivencash;?>
					<tr>
						<td>Due amount of money</td>
						<td><?php echo $duemoney; ?></td>
					</tr>
					<?php  }elseif ($persongivencash>$persontk) {
					 	$payable = $persongivencash-$persontk; ?>
					<tr>
						<td>Payable amount of money</td>
						<td><?php echo $payable; ?></td>
					</tr>
				<?php	} ?>
				</table>
		</div>

</div>
<?php include 'inc/footer.php'; ?>