<?php
include('../includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0){
	header("location:login.php");
}
if(isset($_GET['update'])){
	if(strlen($_GET['ostatus'])>0){
		$ostatus=$_GET['ostatus'];
		$sql = "UPDATE orders set orderStatus='".$ostatus."' where id=".$_GET['oid'];
		$query = mysqli_query($connection,$sql);
		echo "<script>alert('Order Updated Sucessfully');location='pendingorders.php';</script>";		
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
	<link rel="stylesheet" href="../assets/semantic-ui/dist/semantic.css">
	<link rel="stylesheet" href="../assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/owl.carousel.css">

	<script type="text/javascript" src="../assets/jquery/jquery.js"></script>
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
					<label class="ui header">Edit Order Status</label>
					<form class="ui form" method="get">
						<?php

							$sql = "SELECT users.name as username,users.email as useremail,users.contactno as usercontact,users.shippingAddress as shippingaddress,users.shippingCity as shippingcity,users.shippingState as shippingstate,users.shippingPincode as shippingpincode,products.productName as productname,products.shippingCharge as shippingcharge,orders.quantity as quantity,orders.size as size,orders.orderDate as orderdate,orders.orderStatus as ostatus,products.productPrice as productprice,orders.id as id  from orders join users on orders.userId=users.id join products on products.id=orders.productId where orders.id=".intval($_GET['oid']);
							$query = mysqli_query($connection,$sql);
							while($row=mysqli_fetch_array($query)){
						?>
						<div class="ui field">
							<label>User Name: <?php echo $row['username']; ?></label>
						</div>
						<div class="ui field">
							<label>Email: <?php echo $row['useremail']; ?></label>
						</div>
						<div class="ui field">
							<label>Phone: <?php echo $row['usercontact']; ?></label>
						</div>
						<div class="ui field">
							<label>Address: <?php echo $row['shippingaddress'].", ".$row['shippingcity'].", ".$row['shippingstate'].", ".$row['shippingpincode']; ?></label>
						</div>
						<div class="ui field">
							<label>Product: <?php echo $row['productname']; ?></label>
						</div>
						<div class="ui field">
							<?php 
								$size=$row['size'];
								$qty=$row['quantity'];
								$cur_price = $row['productprice'];
								$shipping= $row['shippingcharge']; ?>
								<label name="size">
								Size:
								<?php if($size=="small"){
									$cur_price=$cur_price/4;
									echo "Small - 250gram";
								}elseif ($size=="medium") {
									$cur_price=$cur_price/2;
									echo "Medium - 500gram";
								}else{
									$cur_price=$cur_price;												
									echo "Large - 1Kg";
								} 
							?>
							</label>
							<label name="quantity">Quantity: <?php echo $qty; ?></label>
						</div>
						<div class="ui field">
							<label>Shipping Charge: <?php echo htmlentities($shipping);?></label>
						</div>
						<div class="ui field">
							<label>Net Value: <?php echo htmlentities(($qty*$cur_price)+$shipping);?></label>
						</div>
						<div class="ui field">
							<label>Status: </label>
							<select name="ostatus">
								<option value="">Select Status</option>
								<option value="packed" <?php if($row['ostatus']=='packed') echo "selected";?>>Packed</option>
								<option value="shipped" <?php if($row['ostatus']=='shipped') echo "selected";?>>Shipped</option>
								<option value="delivered" <?php if($row['ostatus']=='delivered') echo "selected";?>>Delivered</option>
							</select>
						</div>
						<div class="ui field" style="display: none;">
							<input type="text" name="oid" value="<?php echo $row['id']; ?>">
						</div>
						<div class="ui field" align="center">
							<button type="submit" name="update" class="ui primary button">Update</button>
						</div>
						<?php
							}
						?>
					</form>
				</div>
			</div>
			<div class="row footer" align="center" style="padding: 10% !important;">
				<div class="column">
					Powered by Cousins Lab - 2017
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../assets/semantic-ui/dist/semantic.js"></script>
	<script type="text/javascript" src="../assets/js/owl.carousel.js"></script>
	<script type="text/javascript" src="../assets/js/main.js"></script>	
</body>
</html>		