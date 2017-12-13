<?php
include('../includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0){
	header("location:login.php");
}
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['update'])){
	$prodName=$_POST['prodName'];
	$prodDesc=$_POST['prodDesc'];
	$cat=$_POST['cat'];
	$subcat=$_POST['subcat'];
	$imgInp=$_FILES['imgInp'];
	$selPri=$_POST['selPri'];
	$actPri=$_POST['actPri'];
	$shipCha=$_POST['shipCha'];
	$prodimage=$_POST['prodimage'];
	$prodId=$_POST['prodId'];
	
	if(strlen($imgInp['name'])>0){
		$prodImageName=$imgInp["name"];
		$target_dir = "appimage/product/".$prodName."/";
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}
		$imageFileType = pathinfo($prodImageName,PATHINFO_EXTENSION);

		$prodImageName=$prodName.".". $imageFileType;
		$target_file = $target_dir . $prodImageName;
		move_uploaded_file($imgInp["tmp_name"], $target_file);
	}else{
		$prodImageName=$_POST['prodimage'];
	}
	$sql = "UPDATE products SET subCategory='$subcat', productName='$prodName', productPrice='$selPri', productPriceBeforeDiscount='$actPri', productDescription='$prodDesc', productImage='$prodImageName', shippingCharge='$shipCha', updationDate='$currentTime' where id='$prodId'";
	$query = mysqli_query($connection,$sql);
	if($query){
		echo "<script>alert('Product updated');location='manageproducts.php';</script>";
	}else{
		echo "<script>alert('Something went wrong please try again after some times.');location='manageproducts.php';</script>";
	}
}
if(isset($_POST['insert'])){
	$prodName=$_POST['prodName'];
	$prodDesc=$_POST['prodDesc'];
	$cat=$_POST['cat'];
	$subcat=$_POST['subcat'];
	$imgInp=$_FILES['imgInp'];
	$selPri=$_POST['selPri'];
	$actPri=$_POST['actPri'];
	$shipCha=$_POST['shipCha'];

	$prodImageName=$imgInp["name"];
	$target_dir = "appimage/product/".$prodName."/";
	if (!file_exists($target_dir)) {
		mkdir($target_dir, 0777, true);
	}
	$imageFileType = pathinfo($prodImageName,PATHINFO_EXTENSION);

	$prodImageName=$prodName.".". $imageFileType;
	$target_file = $target_dir . $prodImageName;
	move_uploaded_file($imgInp["tmp_name"], $target_file);

	$sql = "INSERT into products (subCategory, productName, productDescription, productCompany, productPrice, productPriceBeforeDiscount, productImage, shippingCharge, updationDate) VALUES ('$subcat', '$prodName', '$prodDesc', 'self', '$selPri', '$actPri', '$prodImageName', '$shipCha', '$currentTime')";
	$query = mysqli_query($connection,$sql);
	if($query){
		echo "<script>alert('Product updated');location='manageproducts.php';</script>";
	}else{
		echo "<script>alert('Something went wrong please try again after some times.');location='manageproducts.php';</script>";
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
			<div class="row">
				<div class="four wide column">
				</div>
				<div class="eight wide column">
					<label class="ui header">Add / Edit Product</label>
					<form class="ui form" method="post" enctype="multipart/form-data">
						<?php
							if(strlen($_GET['pid'])>0)
							{
								$catid=intval($_GET['pid']);
								$sql = "SELECT products.id as prodid, products.subCategory as prodSubCatId, subcategory.categoryid as prodCatID, products.productName as productName, products.productDescription as prodDesc, products.productPrice as prodPrice, products.productPriceBeforeDiscount as prodDiscount, products.productImage as productImage, products.shippingCharge as prodShip, products.productAvailability as prodAvail, category.categoryName as catName, subcategory.subcategory as subCatName, subcategory.isAvailable as subCatAvail, category.isAvailable as catAvail from products JOIN subcategory ON products.subCategory = subcategory.id JOIN category ON category.id = subcategory.categoryid where products.id= $catid";
								$query = mysqli_query($connection,$sql);
								while($row=mysqli_fetch_array($query)){
						?>
							<div class="ui field">
								<label>Product Name</label>
								<input type="text" name="prodName" placeholder="Product name" value="<?php echo $row['productName']; ?>" required>
							</div>
							<div class="ui field">
								<label>Product Description</label>
								<textarea placeholder="Product description" name="prodDesc" required><?php echo $row['prodDesc']; ?></textarea>
							</div>
							<div class="ui field">
								<label>Product Category</label>
								<select name="cat" required onchange="getSubcat(this.value)">
									<option value="">Select Category</option>
									<?php 
										$sqlcat = "SELECT * from category";
										$querycat = mysqli_query($connection,$sqlcat);
										while ($rowcat=mysqli_fetch_array($querycat)) {
									?>
										<option value="<?php echo $rowcat['id'] ?>" <?php if($rowcat['id']==$row['prodCatID']){ echo "selected";} ?>> <?php echo $rowcat['categoryName'] ?> </option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="ui field">
								<label>Product Sub-Category</label>
								<select name="subcat" id="subcat" required>
									<option value="">Select Sub-Category</option>
									<?php 
										$sqlsubcat = "SELECT * from subcategory where categoryid=".$row['prodCatID'];
										$querysubcat = mysqli_query($connection,$sqlsubcat);
										while ($rowsubcat=mysqli_fetch_array($querysubcat)) {
									?>
										<option value="<?php echo $rowsubcat['id'] ?>" <?php if($rowsubcat['id']==$row['prodSubCatId']){ echo "selected";} ?>> <?php echo $rowsubcat['subcategory'] ?> </option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="ui field">
								<label>Product Image</label>
								<input type="file" class="ui small fluid button" id="imgInp" name="imgInp" accept="image/x-png,image/gif,image/jpeg">
								<span>*use 400x400 image for better quality<span/>
								<br><br>
								<img src="appimage/product/<?php echo $row['productName']."/".$row['productImage']; ?>" class="ui medium image" id="prodImgPre">
							</div>
							<div class="ui field">
								<label>Selling Price</label>
								<input type="number" name="selPri" placeholder="Selling Price" value="<?php echo $row['prodPrice']; ?>" required>
							</div>
							<div class="ui field">
								<label>Actual Price</label>
								<input type="number" name="actPri" placeholder="Actual Price" value="<?php echo $row['prodDiscount']; ?>" required>
							</div>
							<div class="ui field">
								<label>Shipping Charge</label>
								<input type="number" name="shipCha" placeholder="Shipping Charge" value="<?php echo $row['prodShip']; ?>" required>
							</div>
							<div class="ui field" style="display: none;">
								<input type="text" name="prodimage" id="prodimage" value="<?php echo $row['productImage']; ?>">
								<input type="text" name="prodId" value="<?php echo $catid; ?>">
							</div>
							<div class="ui field" align="center">
								<button type="submit" name="update" class="ui primary button">Update</button>	
							</div>
						<?php			
								}
							}else{
						?>
							<div class="ui field">
								<label>Product Name</label>
								<input type="text" name="prodName" placeholder="Product name" required>
							</div>
							<div class="ui field">
								<label>Product Description</label>
								<textarea placeholder="Product description" name="prodDesc" required></textarea>
							</div>
							<div class="ui field">
								<label>Product Category</label>
								<select name="cat" required onchange="getSubcat(this.value)">
									<option value="">Select Category</option>
									<?php 
										$sqlcat = "SELECT * from category";
										$querycat = mysqli_query($connection,$sqlcat);
										while ($rowcat=mysqli_fetch_array($querycat)) {
									?>
										<option value="<?php echo $rowcat['id'] ?>"> <?php echo $rowcat['categoryName'] ?> </option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="ui field">
								<label>Product Sub-Category</label>
								<select name="subcat" id="subcat" required>
									<option value="">Select Sub-Category</option>
									<?php 
										$sqlsubcat = "SELECT * from subcategory";
										$querysubcat = mysqli_query($connection,$sqlsubcat);
										while ($rowsubcat=mysqli_fetch_array($querysubcat)) {
									?>
										<option value="<?php echo $rowsubcat['id'] ?>"> <?php echo $rowsubcat['subcategory'] ?> </option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="ui field">
								<label>Product Image</label>
								<input type="file" class="ui small fluid button" id="imgInp" name="imgInp" accept="image/x-png,image/gif,image/jpeg" required>
								<span>*use 400x400 image for better quality<span/>
								<br><br>
								<img src="" class="ui medium image" id="prodImgPre">
							</div>
							<div class="ui field">
								<label>Selling Price</label>
								<input type="number" name="selPri" placeholder="Selling Price" required>
							</div>
							<div class="ui field">
								<label>Actual Price</label>
								<input type="number" name="actPri" placeholder="Actual Price" required>
							</div>
							<div class="ui field">
								<label>Shipping Charge</label>
								<input type="number" name="shipCha" placeholder="Shipping Charge" required>
							</div>
							<div class="ui field" style="display: none;">
								<input type="text" name="prodId" value="">
							</div>
							<div class="ui field" align="center">
								<button type="submit" name="insert" class="ui primary button">Insert</button>	
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
	<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#prodImgPre').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
			$('#prodimage').val(input.files[0].name);			
		}
	}
	$("#imgInp").change(function() {
		readURL(this);
	});
	function getSubcat(val) {
		$.ajax({
		type: "POST",
		url: "getsubcat.php",
		data:'cat_id='+val,
		success: function(data){
			$("#subcat").html(data);
		}
		});
	}	
	</script>
</body>
</html>