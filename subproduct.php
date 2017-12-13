<?php
include('includes/config.php');
error_reporting(0);
$cid=intval($_GET['cid']);
if(!($cid)){
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
	<style type="text/css">
		.row.section{
			margin-top: 2% !important; 
		}
	</style>
</head>
<body>
	<?php include('includes/menu-bar.php');?>
	<div class="pusher dimmed">
		<div class="ui page vertically divided centered grid">
			<div class="row">
				<div class="column">
					<?php 
						$sql= "SELECT categoryName from category where id='$cid'";
						$result = mysqli_query($connection,$sql);
						while($row = mysqli_fetch_array($result)){
					?>
						<h1 class="ui header"><?php echo htmlentities($row['categoryName']);?></h1>
					<?php } ?>
				</div>
			</div>
			<div class="row section">
				<div class="column">
					<div class="ui three stackable link cards">
						<?php
						$sql= "SELECT products.id as prodid, products.productName as productName, products.productPrice as prodPrice, products.productPriceBeforeDiscount as prodDiscount, products.productImage as productImage, category.categoryName as catName, subcategory.subcategory as subCatName from products JOIN subcategory ON products.subCategory = subcategory.id JOIN category ON category.id = subcategory.categoryid and subcategory.isAvailable = 1 and category.isAvailable = 1 and category.id='$cid'";
						$result = mysqli_query($connection,$sql);
						$num=mysqli_num_rows($result);
						if($num>0)
						{
							while($row = mysqli_fetch_array($result)){
						?>
							<a href="product.php?pid=<?php echo htmlentities($row['prodid']);?>" class="card">
								<div class="image">
									<img class="ui circled image" src="admin/appimage/product/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage']);?>">
								</div>
								<div class="center aligned content">
									<div class="header"><?php echo htmlentities($row['productName']);?></div>
									<div class="description">
										<br>
										<div class="ui unstackable grid">
											<div class="row">
												<div class="column">
													<span class='price'>
														Rs. <?php echo htmlentities($row['prodPrice']);?>
													</span>
													<br>
													<?php if(intval($row['prodDiscount'])>0)
														echo "<span class='price-before-discount'>Rs.".$row['prodDiscount']."</span>";
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</a>
						<?php 
							}
						} else {?>
							<div class="col-sm-6 col-md-4 wow fadeInUp"> <h3>No Product Found</h3>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
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