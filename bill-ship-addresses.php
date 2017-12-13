<?php
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0){
	header("location:login.php");
}else{
	// code for billing address updation
	if(isset($_POST['update']))
	{
		$saddress=$_POST['uaddress'];
		$sstate=$_POST['ustate'];
		$scity=$_POST['ucity'];
		$spincode=$_POST['upin'];
		$sql="UPDATE users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode',updationDate=NOW() where id='".$_SESSION['id']."'";
		$query = mysqli_query($connection,$sql);
		if($query){
			echo "<script>alert('Shipping Address has been updated');location='my-cart.php';</script>";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Thean</title>

	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" href="assets/semantic-ui/dist/semantic.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">

	<script type="text/javascript" src="assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$("#preloader").show();
	</script>
</head>
<body>
	<?php include('includes/menu-bar.php');?>
	<div class="pusher">
		<div class="ui stackable page grid">
			<div class="row section">
				<div class="four wide column">

				</div>
				<div class="eight wide column">
					<label class="ui header">Edit Address</label>
					<br><br>
					<?php
						$sql="SELECT * from users where id='".$_SESSION['id']."'";
						$query = mysqli_query($connection,$sql);
						while($row=mysqli_fetch_array($query))
						{
					?>
					<form class="ui form" method="post">
						<div class="required field">
							<label>Address</label>
							<input type="text" name="uaddress" id="uaddress" placeholder="Address" value="<?php echo $row['shippingAddress'];?>" required>
						</div>
						<div class="required field">
							<label>State</label>
							<input type="text" name="ustate" id="ustate" placeholder="State" value="<?php echo $row['shippingState'];?>" required>
						</div>
						<div class="required field">
							<label>City</label>
							<input type="text" name="ucity" id="ucity" placeholder="City" value="<?php echo $row['shippingCity'];?>" required>
						</div>
						<div class="required field">
							<label>Pin Code</label>
							<input type="number" name="upin" id="upin" placeholder="Pin Code" value="<?php echo $row['shippingPincode'];?>" required>
						</div>							
						<div class="field" align="center">
							<button type="submit" name="update" class="ui primary button">Update</button>
						</div>
					</form>
					<?php } ?>					
				</div>
			</div>
			<div class="row">
				<div class="column">
					Powered by Cousins Lab - 2017
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="assets/semantic-ui/dist/semantic.js"></script>
	<script type="text/javascript" src="assets/js/owl.carousel.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>	
</body>
</html>