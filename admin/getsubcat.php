<?php
	include('../includes/config.php');
	error_reporting(0);
	if(!empty($_POST["cat_id"])) 
	{
		$id=intval($_POST['cat_id']);
		$sql="SELECT * FROM subcategory WHERE categoryid=$id";
		$query = mysqli_query($connection,$sql);
?>
	<option value="" selected>Select Subcategory</option>
	<?php
		while($row=mysqli_fetch_array($query))
		{
	?>
		<option value="<?php echo htmlentities($row['id']); ?>">
			<?php echo htmlentities($row['subcategory']); ?>
		</option>
	<?php
		}
	}
	?>