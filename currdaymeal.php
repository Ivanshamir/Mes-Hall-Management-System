<?php include 'inc/header.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
		$("form").submit(function(){
			var roll = true;
			$(':radio').each(function(){
				name = $(this).attr('name');
				if (roll && !$(':radio[name="' + name + '"]:checked').length) {
					$('.alert').show();
					roll = false;
				}
			});
			return roll;
		});
	});
</script>


<?php
	error_reporting(0);
	$cur_time = date("Y-m-d");

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$countmeal = $_POST['countmeal'];	
		$comeal = $user->countMemberMeal($cur_time, $countmeal, $managerid);
	 }
?>

<?php 
	if (isset($comeal)) {
		echo $comeal;
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
				<strong>Date : </strong><?php echo $cur_time; ?>
			</div>
			<div class='alert alert-danger' style="display: none;"><strong>Error ! </strong> Member Meal count missing</div>
			<form action="" method="post">
				<table class="table table-striped">
					<tr>
						<th width="25%">No</th>
						<th width="30%">Member Name</th>
						<th width="20%">Member Id</th>
						<th width="25%">Count Meal</th>
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
						<td>
							<?php echo $result['memid']; ?>	
						</td>
						<td>
							<input type="radio" name="countmeal[<?php echo $result['memid']; ?>]" value="0"> 0 ||
							<input type="radio" name="countmeal[<?php echo $result['memid']; ?>]" value="1"> 1 ||
							<input type="radio" name="countmeal[<?php echo $result['memid']; ?>]" value="2"> 2 ||
							<input type="radio" name="countmeal[<?php echo $result['memid']; ?>]" value="3"> 3 
						</td>
					</tr>
			<?php } } }?>
					<div class="form-group">
						<input type="hidden" name="mng_id" class="form-control" value="<?php echo $managerid; ?>">
					</div>

					<tr>
						<td colspan="4"><input class="btn btn-primary" type="submit" name="submit" value="Submit"></td>
					</tr>
				</table>
			</form>
		</div>
<?php include 'inc/footer.php'; ?>