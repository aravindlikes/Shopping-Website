<?php
include('../includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0){
	header("location:login.php");
}
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['update'])){
	$subCatName=$_POST['subCategoryName'];
	$catId=$_POST['categoryId'];
	$subCatId=intval($_POST['cid']);
	$sql="UPDATE subcategory SET subcategory='$subCatName', categoryid='$catId',updationDate='$currentTime' where id=".$subCatId;
	$query = mysqli_query($connection,$sql);
	if($query){
		echo "<script>alert('Category updated');location='managesubcategory.php';</script>";
	}else{
		echo "<script>alert('Something went wrong please try again after some times.');location='managesubcategory.php';</script>";
	}
}
if(isset($_POST['insert'])){
	$subCatName=$_POST['subCategoryName'];
	$catId=$_POST['categoryId'];
	$sql="INSERT into subcategory(categoryid,subcategory) VALUES ('$catId', '$subCatName')";
	$query = mysqli_query($connection,$sql);
	if($query){
		echo "<script>alert('Category updated');location='managesubcategory.php';</script>";
	}else{
		echo "<script>alert('Something went wrong please try again after some times.');location='managesubcategory.php';</script>";
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
					<label class="ui header">Add / Edit Sub-Category</label>
					<form class="ui form" method="post">
						<?php
							if(strlen($_GET['subcat'])>0)
							{
								$catid=intval($_GET['subcat']);
								$sql = "SELECT subcategory.id as id, category.categoryName as categoryName, subcategory.categoryid as categoryId, subcategory.subcategory as subCategoryName from subcategory join category on category.id=subcategory.categoryid where subcategory.id= $catid";
								$query = mysqli_query($connection,$sql);
								while($row=mysqli_fetch_array($query)){
						?>
							<div class="ui field">
								<label>Sub Category Name</label>
								<input type="text" name="subCategoryName" value="<?php echo $row['subCategoryName']; ?>" required>
							</div>
							<div class="ui field">
								<label>Select Category</label>
								<select name="categoryId" required>
									<option value="">Select Category</option>
									<?php
										$sql = "SELECT * from category";
										$catquery = mysqli_query($connection,$sql);
										while($cat=mysqli_fetch_array($catquery)){
									?>
										<option value="<?php echo $cat['id']; ?>" <?php if($row['categoryId']==$cat['id']) {echo "selected";} ?> ><?php echo $cat['categoryName']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="ui field" style="display: none;">
								<input type="text" name="cid" value="<?php echo $catid; ?>">
							</div>
							<div class="ui field" align="center">
								<button type="submit" name="update" class="ui primary button">Update</button>	
							</div>
						<?php			
								}
							}else{
						?>
							<div class="ui field">
								<label>Sub Category Name</label>
								<input type="text" name="subCategoryName" value="<?php echo $row['subCategoryName']; ?>" required>
							</div>
							<div class="ui field">
								<label>Select Category</label>
								<select name="categoryId" required>
									<option value="">Select Category</option>
									<?php
										$sql = "SELECT * from category";
										$catquery = mysqli_query($connection,$sql);
										while($cat=mysqli_fetch_array($catquery)){
									?>
										<option value="<?php echo $cat['id']; ?>" <?php if($row['categoryId']==$cat['id']) {echo "selected";} ?> ><?php echo $cat['categoryName']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="ui field" style="display: none;">
								<input type="text" name="cid" value="">
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
</body>
</html>		