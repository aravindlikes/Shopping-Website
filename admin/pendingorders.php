<?php
include('../includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0){
	header("location:login.php");
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
	<link rel="stylesheet" type="text/css" href="../assets/datatables/media/css/dataTables.semanticui.css">

	<script type="text/javascript" src="../assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$("#preloader").show();
	</script>
</head>
<body>
	<?php include('includes/menu-bar.php');?>
	<div class="pusher">
		<div class="ui stackable page grid">
			<div class="row" align="center">
				<div class="column">
					<label class="ui header">Pending Orders</label>				
				</div>
			</div>
			<div class="row section">
				<div class="column">
					<table class="ui table">
						<thead>
							<tr>
								<th>#</th>
								<th> Name</th>
								<th width="50">Email /Contact no</th>
								<th>Shipping Address</th>
								<th>Product </th>
								<th>Qty </th>
								<th>Amount </th>
								<th>Order Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$status='delivered';
								$sql="SELECT users.name as username,users.email as useremail,users.contactno as usercontact,users.shippingAddress as shippingaddress,users.shippingCity as shippingcity,users.shippingState as shippingstate,users.shippingPincode as shippingpincode,products.productName as productname,products.shippingCharge as shippingcharge,orders.quantity as quantity,orders.size as size,orders.orderDate as orderdate,products.productPrice as productprice,orders.id as id  from orders join users on  orders.userId=users.id join products on products.id=orders.productId where orders.	orderStatus!='$status' or orders.orderStatus is null";
								$query = mysqli_query($connection,$sql);
								$cnt=1;
								while($row=mysqli_fetch_array($query)){
							?>
							<tr>
								<td><?php echo htmlentities($cnt);?></td>
								<td><?php echo htmlentities($row['username']);?></td>
								<td><?php echo htmlentities($row['useremail']);?>/<?php echo htmlentities($row['usercontact']);?></td>
								<td><?php echo htmlentities($row['shippingaddress'].",".$row['shippingcity'].",".$row['shippingstate']."-".$row['shippingpincode']);?></td>
								<td><?php echo htmlentities($row['productname']);?></td>
																	
								<td>
									<?php 
										$size=$row['size'];
										$qty=$row['quantity'];
										$cur_price = $row['productprice'];
										$shipping= $row['shippingcharge']; ?>
										<b>
										<label name="size">
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
										</label><br>
										<label name="quantity"><?php echo $qty; ?></label>
										</b>
								</td>
								<td><?php echo htmlentities(($qty*$cur_price)+$shipping);?></td>
								<td><?php echo htmlentities($row['orderdate']);?></td>
								<td>
									<a class="ui primary icon button" href="updateorder.php?oid=<?php echo htmlentities($row['id']);?>">
										<i class="icon edit"></i>
									</a>
								</td>
							</tr>
							<?php $cnt=$cnt+1; } ?>
						</tbody>
					</table>
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
	<script type="text/javascript" src="../assets/datatables/media/js/jquery.dataTables.js"></script>	
	<script type="text/javascript" src="../assets/datatables/media/js/dataTables.semanticui.js"></script>
	<script type="text/javascript" src="../assets/js/main.js"></script>
	<script type="text/javascript">
		$(".ui.table").DataTable();
	</script>
</body>
</html>		