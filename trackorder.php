<?php
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0){
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
	<link rel="stylesheet" href="assets/semantic-ui/dist/semantic.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="assets/datatables/media/css/dataTables.semanticui.css">

	<script type="text/javascript" src="assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$("#preloader").show();
	</script>
</head>
<body>
	<?php include('includes/menu-bar.php');?>
	<div class="pusher">
		<div class="ui stackable page grid">
			</div>
			<div class="row section">
				<div class="column">
					<label class="ui header">Track Order</label>
					<br><br>				
					<table class="ui compact celled table">
						<thead>
							<tr>
								<th class="cart-romove item">#</th>
								<th class="cart-description item">Image</th>
								<th class="cart-product-name item">Product Name</th>
								<th class="cart-sub-total item">Price Per unit (Rs.)</th>
								<th class="cart-sub-total item">Shipping Charge (Rs.)</th>
								<th class="cart-total item">Grandtotal (Rs.)</th>
								<th class="cart-total item">Status</th>
								<th class="cart-description item">Order Date</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$sql="SELECT products.productImage as pimg1,products.productName as pname,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,products.shippingCharge as shippingcharge,orders.size as size, orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid, orders.orderStatus as ostatus from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."'";
								$query=mysqli_query($connection,$sql);
								$cnt=1;
								while($row=mysqli_fetch_array($query)){
							?>
							<tr>
								<td><?php echo $cnt;?></td>
								<td class="cart-image">
									<img src="admin/appimage/product/<?php echo $row['pname'];?>/<?php echo $row['pimg1'];?>" class="ui tiny image">
								</td>
								<td class="cart-product-name-info">
									<h4 class='cart-product-description'>
										<a href="product.php?pid=<?php echo $row['opid'];?>">
											<?php echo $row['pname'];?>
										</a>
									</h4>
									<?php 
										$size=$row['size'];
										$qty=$row['qty']; ?>
										<b>
										<label name="size">
											<?php if($size=="small"){
												echo "Small - 250gram";
											}elseif ($size=="medium") {
												echo "Medium - 500gram";
											}else{
												echo "Large - 1Kg";
											} 
											?>
										</label><br>
										<label name="quantity"><?php echo $qty; ?></label>
										</b>									
								</td>
								<td class="cart-product-sub-total">
									<span class="cart-sub-total-price">
										<?php
											$cur_price = $row['pprice'];
											if($size=="small"){
												$cur_price=$cur_price/4;
												echo ($cur_price);
											}elseif ($size=="medium") {
												$cur_price=$cur_price/2;
												echo ($cur_price);
											}else{
												echo ($cur_price);
											}?>.00
									</span>									
								</td>
								<td class="cart-product-sub-total"><?php echo $shippcharge=$row['shippingcharge']; ?>  </td>
								<td class="cart-product-grand-total"><?php echo (($qty*$cur_price)+$shippcharge);?></td>
								<td class="cart-product-sub-total">
									<?php 
										if (strlen($row['ostatus'])>0){
											echo htmlentities($row['ostatus']);
										}else{
											echo "Order Placed";
										} 
									?>
								</td>
								<td class="cart-product-sub-total"><?php echo $row['odate']; ?>  </td>
							</tr>
							<?php $cnt=$cnt+1;} ?>
						</tbody><!-- /tbody -->
					</table><!-- /table -->
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
	<script type="text/javascript" src="assets/datatables/media/js/jquery.dataTables.js"></script>	
	<script type="text/javascript" src="assets/datatables/media/js/dataTables.semanticui.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
	<script type="text/javascript">
		$(".ui.table").DataTable();
	</script>
</body>
</html>