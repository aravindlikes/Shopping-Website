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
					<label class="ui header">Products</label>
					<br>
				</div>
			</div>			
			<div class="row section">
				<div class="column">
					<a class="ui primary button" href="addproduct.php">Add Product</a>
					<br><br>
					<table class="ui table">
						<thead>
							<tr>
								<th>#</th>
								<th>Product</th>
								<th>Category Name</th>
								<th>Sub Category Name</th>
								<th>Actual Price</th>
								<th>Discount Price</th>
								<th>Shipping Charge</th>								
								<th>Availability</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql="SELECT products.id as prodid, products.productName as productName, products.productPrice as prodPrice, products.productPriceBeforeDiscount as prodDiscount, products.productImage as productImage, products.shippingCharge as prodShip, products.productAvailability as prodAvail, category.categoryName as catName, subcategory.subcategory as subCatName, subcategory.isAvailable as subCatAvail, category.isAvailable as catAvail from products JOIN subcategory ON products.subCategory = subcategory.id JOIN category ON category.id = subcategory.categoryid";
								$query = mysqli_query($connection,$sql);
								$cnt=1;
								while($row=mysqli_fetch_array($query)){
							?>
							<tr>
								<td><?php echo htmlentities($cnt);?></td>
								<td>
									<img src="appimage/product/<?php echo $row['productName']."/".$row['productImage'] ?>" class="ui tiny image">
									<label class="header"><b><?php echo htmlentities($row['productName']);?></b></label>
								</td>
								<td><?php echo htmlentities($row['catName']);?></td>
								<td><?php echo htmlentities($row['subCatName']);?></td>
								<td><?php echo htmlentities($row['prodPrice']);?></td>
								<td><?php echo htmlentities($row['prodDiscount']);?></td>
								<td><?php echo htmlentities($row['prodShip']);?></td>
								<td>
									<?php 
										if(!$row['catAvail']){
											echo "<a href='managecategory.php'>Category Disabled. Edit Category Status</a>";
										}else if(!$row['subCatAvail']){
											echo "<a href='managesubcategory.php'>Sub-category Disabled. Edit Sub-Category Status</a>";
										}else if($row['prodAvail']){
											echo "In Stock";
										}else{
											echo "Out of Stock";
										}
									?>
								</td>
								<td>
									<?php 
										if($row['prodAvail']){
									?>
									<a class="ui red icon button" title="Out of stock" href="deleteproduct.php?pid=<?php echo htmlentities($row['prodid']);?>&act=disable">
										<i class="lock icon"></i>
									</a>
									<?php }else {
									?>
									<a class="ui green icon button" title="In stock" href="deleteproduct.php?pid=<?php echo htmlentities($row['prodid']);?>&act=enable">
										<i class="unlock icon"></i>
									</a>
									<?php } ?>
									<a class="ui primary icon button" href="addproduct.php?pid=<?php echo htmlentities($row['prodid']);?>">
										<i class="edit icon"></i>
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