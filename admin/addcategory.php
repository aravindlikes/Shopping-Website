<?php
include('../includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0){
	header("location:login.php");
}
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['update'])){
	$catName=$_POST['catname'];
	$catDesc=$_POST['catdesc'];
	$catid=intval($_POST['cid']);
	$catImage=$_FILES['imgInp'];
	if(strlen($catImage['name'])>0){
		$catImageName=$catImage["name"];
		$target_dir = "appimage/category/";
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}
		$imageFileType = pathinfo($catImageName,PATHINFO_EXTENSION);

		$catImageName=$catName.".". $imageFileType;
		$target_file = $target_dir . $catImageName;
		move_uploaded_file($catImage["tmp_name"], $target_file);
	}else{
		$catImageName=$_POST['catimage'];
	}

	$sql="UPDATE category set categoryName='$catName',categoryDescription='$catDesc',updationDate='$currentTime',categoryImage='$catImageName' where id='$catid'";
	$query = mysqli_query($connection,$sql);
	if($query){
		echo "<script>alert('Category updated');location='managecategory.php';</script>";
	}else{
		echo "<script>alert('Something went wrong please try again after some times.');location='managecategory.php';</script>";
	}
}
if(isset($_POST['insert'])){
	$catName=$_POST['catname'];
	$catDesc=$_POST['catdesc'];
	$catImage=$_FILES['imgInp'];
	$catImageName=$catImage["name"];
	$target_dir = "appimage/category/";
	if (!file_exists($target_dir)) {
		mkdir($target_dir, 0777, true);
	}
	$imageFileType = pathinfo($catImageName,PATHINFO_EXTENSION);
	$catImageName=$catName.".". $imageFileType;
	$target_file = $target_dir . $catImageName;
	move_uploaded_file($catImage["tmp_name"], $target_file);
	$sql ="INSERT into category(categoryName,categoryDescription,categoryImage) VALUES ('$catName','$catDesc','$catImageName')";
	$query = mysqli_query($connection,$sql);
	if($query){
		echo "<script>alert('Category updated');location='managecategory.php';</script>";
	}else{
		echo "<script>alert('Something went wrong please try again after some times.');location='managecategory.php';</script>";
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
					<label class="ui header">Add / Edit Category</label>
					<form class="ui form" method="post" enctype = "multipart/form-data">
						<?php
							if(strlen($_GET['cat'])>0)
							{
								$catid=intval($_GET['cat']);
								$sql = "SELECT * from category where id= $catid";
								$query = mysqli_query($connection,$sql);
								while($row=mysqli_fetch_array($query)){
						?>
							<div class="ui field">
								<label>Category Name</label>
								<input type="text" name="catname" value="<?php echo $row['categoryName']; ?>" required>
							</div>
							<div class="ui field">
								<label>Category Desc</label>
								<textarea name="catdesc" row="2" required><?php echo $row['categoryDescription']; ?></textarea>
							</div>
							<div class="ui field">
								<label>Category Image</label>
								<input type="file" class="ui small fluid button" id="imgInp" name="imgInp" accept="image/x-png,image/gif,image/jpeg">
								<span>*use 400x400 image for better quality<span/>
								<br><br>
								<img src="appimage/category/<?php echo $row['categoryImage']; ?>" class="ui medium image" id="catImgPre">
							</div>
							<div class="ui field" style="display: none;">
								<input type="text" name="catimage" id="catimage" value="<?php echo $row['categoryImage']; ?>">
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
								<label>Category Name</label>
								<input type="text" name="catname" required>
							</div>
							<div class="ui field">
								<label>Category Desc</label>
								<textarea name="catdesc" row="2" required></textarea>
							</div>
							<div class="ui field">
								<label>Category Image</label>
								<input type="file" class="ui small fluid button" id="imgInp" name="imgInp" accept="image/x-png,image/gif,image/jpeg" required>
								<span>*use 400x400 image for better quality<span/>
								<br><br>
								<img src="" class="ui medium image" id="catImgPre">
							</div>
							<div class="ui field" style="display: none;">
								<input type="text" name="catimage" id="catimage" value="">
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
	<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#catImgPre').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
			$('#catimage').val(input.files[0].name);			
		}
	}
	$("#imgInp").change(function() {
		readURL(this);
	});
	</script>
</body>
</html>		