<?php 
include('includes/config.php');
error_reporting(0);

// Code for Remove a Product from Cart
if(isset($_POST['remove']))
{
	if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){
			unset($_SESSION['cart'][$key]);
		}
		echo "<script>alert('Your Cart has been Updated');</script>";
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
</head>
<body>
	<?php include('includes/menu-bar.php');?>	
	<div class="pusher dimmed">
		<div class="ui grid">
			<div class="row section">
				<div class="column">
					<label class="ui header">
						Shopping cart
					</label><br><br>
					<form name="cart" method="post">	
						<?php
							if(!empty($_SESSION['cart'])){
						?>
						<table class="ui stackable celled table">
							<thead>
								<tr>
									<th>Remove</th>
									<th>Product</th>
									<th>Quantity</th>
									<th>Price Per unit (Rs.)</th>
									<th>Shipping Charge (Rs.)</th>
									<th>Grandtotal (Rs.)</th>
								</tr>
							</thead><!-- /thead -->
							<tbody>
								<?php
									$pdtid=array();
									$sql = "SELECT * FROM products WHERE id IN(";
									foreach($_SESSION['cart'] as $id => $value){
										$sql .=$id. ",";
									}
									$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
									$query = mysqli_query($connection,$sql);
									$totalprice=0;
									$totalqunty=0;
									if(!empty($query)){
										while($row = mysqli_fetch_array($query)){
											$quantity=$_SESSION['cart'][$row['id']]['quantity'];
											$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
											$totalprice += $subtotal;
											$_SESSION['qnty']=$totalqunty+=$quantity;
											array_push($pdtid,$row['id']);
								?>
								<tr>
									<td>
										<input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']);?>" class="remove_check" />
									</td>
									<td>
										<img class="ui tiny image" src="admin/appimage/product/<?php echo $row['productName'];?>/<?php echo $row['productImage'];?>">
										<label class='ui header'>
											<a href="product.php?pid=<?php echo htmlentities($pd=$row['id']);?>" >
											<?php
												echo $row['productName'];
												$_SESSION['sid']=$pd;
											?>
											</a>
										</label>	 
									</td>
									<td>
										<b>
										<label name="size">
											<?php if($_SESSION['cart'][$row['id']]['size']=="small"){
												echo "Small - 250gram";
											}elseif ($_SESSION['cart'][$row['id']]['size']=="medium") {
												echo "Medium - 500gram";
											}else{
													echo "Large - 1Kg";
											} 
											?>
										</label><br>
										<label name="quantity"><?php echo $_SESSION['cart'][$row['id']]['quantity']; ?></label>
										</b>
						            </td>
									<td>
										<span class="cart-sub-total-price">
											<?php
												$cur_price = $row['productPrice'];
												if($_SESSION['cart'][$row['id']]['size']=="small"){
													$cur_price=$cur_price/4;
													echo ($cur_price);
												}elseif ($_SESSION['cart'][$row['id']]['size']=="medium") {
													$cur_price=$cur_price/2;
													echo ($cur_price);
												}else{
													echo ($cur_price);
												}?>.00
										</span>
									</td>
									<td>
										<span class="cart-sub-total-price"><?php echo $row['shippingCharge']; ?>.00</span>
									</td>
									<td>
										<span class="cart-grand-total-price">
											<?php echo $_SESSION['cart'][$row['id']]['total']=($_SESSION['cart'][$row['id']]['quantity']*$cur_price+$row['shippingCharge']); ?>.00
										</span>
									</td>
								</tr>
							</tbody>
							<tfoot class="full-width">
								<tr>
									<th colspan="7">
										<span class="" align="right">
											<button type="submit" name="remove" class="ui disabled button" id="remove_btn">Remove</button>
											<a href="index.php" class="ui right floated primary button">Continue Shopping</a>
										</span>
									</th>
								</tr>
							</tfoot>
						</table>
					</form>
					<div class="ui stackable grid">
						<div class="row section">
							<div class="seven wide column">
								<table class="ui table">
									<thead>
										<tr>
											<th>Billing Address</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<?php
													if(strlen($_SESSION['login'])==0){
														echo "Login to view Address <br> <a href='login.php' class='ui primary button'>Login</a>";
													}else{
														$sql= "SELECT * from users where id='".$_SESSION['id']."'";
														$result = mysqli_query($connection,$sql);
														while($row = mysqli_fetch_array($result)){
															echo htmlentities($row['shippingAddress'])."<br />";
															echo htmlentities($row['shippingCity'])."<br />";
															echo htmlentities($row['shippingState'])."<br />";
															echo htmlentities($row['shippingPincode']);
														}
													}
												?>													
											</td>
											<td>
												<a href="bill-ship-addresses.php?redirect=my-cart.php" class="ui primary button">Edit Address</a><br><br>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="one wide column"></div>
							<div class="eight wide column">
								<form action="placeOrder.php" method="post">
									<table class="ui table">
										<thead>
											<tr>
												<th>Billing Method</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="ui form">
													<input type="radio" name="paymode" id="cash" checked required value="cash"><label for="cash"> &nbsp;Cash On Deliver</label>
													<br><br>
													<input type="radio" name="paymode" id="online" value="online"><label for="online"> &nbsp;Online Payment</label>
													<br>
												</td>
												<td>
													<button type="submit" name="ordersubmit" class="ui primary button">Place Order</button>
												</td>
											</tr>
										</tbody>
									</table>
								</form>
							</div>
						</div>
					</div>
					<?php
						}}
					}else{
						echo "Cart Empty <br>
							<a href='index.php' class='ui primary button'>Continue Shopping</a>";
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="assets/jquery/jquery.js"></script>
	<script type="text/javascript" src="assets/semantic-ui/dist/semantic.js"></script>
	<script type="text/javascript" src="assets/js/owl.carousel.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
	<script type="text/javascript">
		$('.remove_check').change(function(){
			var checked=$('.remove_check:checkbox:checked');
			if(checked.length>0){
				$("#remove_btn").attr('class','ui red button');				
			}else{
				$("#remove_btn").attr('class','ui disabled button');				
			}
		});
	</script>
</body>
</html>