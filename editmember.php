<?php 
	include 'inc/header.php'; 
?>
<?php
	if (!isset($_GET['memdtid']) || empty($_GET['memdtid'])) {
	 	echo "<script>window.location='memdetail.php';</script>";
	 }else{
	 	$memdtid = $_GET['memdtid'];
	 } 


	 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
		$updmem = $user->updateMember($memdtid, $_POST);
	 }
?>

<?php 
	if (isset($updmem)) {
		echo $updmem;
	}
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-info" href="home.php">Home</a>
			<a class="btn btn-primary pull-right" href="memdetail.php">Back</a>
		</h2>
	</div>
	<div class="panel-body">
		<div style="max-width: 600px;margin: 0 auto;">
		<form action="" method="post">
		<?php 
			$edit_mem = $user->edit_member($memdtid);
			if ($edit_mem) {
				while ( $result = $edit_mem->fetch_assoc()) {
		?>
			<div class="form-group">
				<label for="name">Member Name:</label>
				<input type="text" id="name" name="name" class="form-control" value="<?php echo $result['name']; ?>" >
			</div>			
			<input type="submit" name="update" value="Update" class="btn btn-primary">
		<?php } } ?>
			</form>
		</div>
		
	</div>
</div>
<?php include 'inc/footer.php'; ?>