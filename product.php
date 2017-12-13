<?php 
include('includes/config.php');
error_reporting(0);
$pid=intval($_GET['pid']);
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']=$_GET['qty'];
		$_SESSION['cart'][$id]['size']=$_GET['size'];
		header('location:my-cart.php');
	}else{
		$sql= "SELECT * FROM products WHERE id={$id}";
		$result = mysqli_query($connection,$sql);
		if(mysqli_num_rows($result)!=0){
			$row_p=mysqli_fetch_array($result);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => $_GET['qty'],"size" => $_GET['size'], "price" => $row_p['productPrice']);
			header('location:my-cart.php');
		}else{
			$message="Product ID is invalid";
			echo "<script>alert('$message');</script>";
		}
	}
}else if(!($pid)){
	header('location:index.php');
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
		<br>
		<div class="ui page vertically divided stackable grid">
			<?php
				$sql= "SELECT * from products where id='$pid'";
				$result = mysqli_query($connection,$sql);
				while($row = mysqli_fetch_array($result)){
			?>
			<div class="ui row section">
				<div class="eight wide column">
					<div class="image">
						<img class="ui large image" src="admin/appimage/product/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage']);?>">
					</div>
				</div>
				<div class="eight wide column">
					<div class="ui stackable grid">
						<div class="row">
							<div class="column desc">
								<h1 class="ui header"><?php echo htmlentities($row['productName']);?></h1>
								<label class="ui header value" style="font-size: medium;">
									<?php 
										if($row['productAvailability']){
											echo "In Stock";
										}
										else{
											echo "Out of stock";
										}
									?>
								</label>
								<br><br>
								<label class="ui header" style="font-size: medium;">DESCRIPTION</label>
								<br>
								<?php echo $row['productDescription'];?>
								<br><br>
								<label class="ui header" style="font-size: medium;">PRICE: </label>
								<span class='ui header price value'>
									Rs.<?php echo htmlentities($row['productPrice']);?>
								</span>
								<label>(Per KG)</label>
								<?php if($row['productPriceBeforeDiscount']>0)
									echo "<span class='price-before-discount'>Rs.".$row['productPriceBeforeDiscount']."</span>";
								?><br><br>
								<label class="ui header" style="font-size: medium;">
									SHIPPING CHARGE : 
									<span class="value">
										<?php 
											if($row['shippingCharge']==0){
												echo "Free";
											}else{
												echo "Rs.".htmlentities($row['shippingCharge']);
											}
										?>
									</span>
								</label>
								<br><br>
							</div>
						</div>
						<div class="row">
							<div class="eight wide column">
								<form class="ui form" action="product.php">
									<div class="ui fields">
										<div class="eight wide field">
											<label class="ui header">Size</label>
											<select id="size" name="size">
												<option value="small">Small - 250gram</option>
												<option value="medium">Medium - 500gram</option>
												<option value="large">Large - 1Kg</option>
											</select>
										</div>
										<div class="eight wide field">
											<label class="ui header">Quantity</label>
											<select id="qty" name="qty">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
										</div>
									</div>
									<div style="display: none">
										<input type="text" name="page" id="page" value="product">
										<input type="text" name="action" id="action" value="add">
										<input type="text" name="id" id="id" value="<?php echo $row['id']; ?>">
									</div>
									<?php 
										if($row['productAvailability']){
									?>

										<button type="submit" class="ui icon positive button"><i class="shop icon"></i> ADD TO CART</button>
									<?php
										}else{

											echo "<br><br><label class='ui header'>Product Out of stock</label>";
										}
									?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
				}
			?>
			<div class="row section">
				<div class="column">
					<h1 class="ui header">Contact Us</h1>
					<div class="ui grid segment">
						<div class="row">
							<div class="eight wide column" align="left">
								Address:<br>
								Phone number:<br>
								E-mail:<br>
							</div>
							<div class="eight wide column">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="column">
					Powered by Cousins Lab - 2017
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="assets/jquery/jquery.js"></script>
	<script type="text/javascript" src="assets/semantic-ui/dist/semantic.js"></script>
	<script type="text/javascript" src="assets/js/owl.carousel.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>	
</body>
</html>