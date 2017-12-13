<?php
include('../includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0){
	header("location:login.php");
}
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['update'])){
	$postTitle=$_POST['posttitle'];
	$postContent=$_POST['postcontent'];
	$imgInp=$_FILES['imgInp'];
	$postId=$_POST['postid'];

	if(strlen($imgInp['name'])>0){
		$postImageName=$imgInp["name"];
		$target_dir = "appimage/post/";
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}
		$imageFileType = pathinfo($postImageName,PATHINFO_EXTENSION);

		$postImageName=$postTitle.".". $imageFileType;
		$target_file = $target_dir . $postImageName;
		move_uploaded_file($imgInp["tmp_name"], $target_file);
	}else{
		$postImageName=$_POST['postimage'];
	}
	$sql = "UPDATE blogpost SET posttitle='$postTitle', postcontent='$postContent', postimage='$postImageName' where id='$postId'";
	$query = mysqli_query($connection,$sql);
	if($query){
		echo "<script>alert('Blog updated');location='manageblog.php';</script>";
	}else{
		echo "<script>alert('Something went wrong please try again after some times.');location='manageblog.php';</script>";
	}
}
if(isset($_POST['insert'])){
	$postTitle=$_POST['posttitle'];
	$postContent=$_POST['postcontent'];
	$imgInp=$_FILES['imgInp'];

	$postImageName=$imgInp["name"];
	$target_dir = "appimage/post/";
	if (!file_exists($target_dir)) {
		mkdir($target_dir, 0777, true);
	}
	$imageFileType = pathinfo($postImageName,PATHINFO_EXTENSION);

	$postImageName=$postTitle.".". $imageFileType;
	$target_file = $target_dir . $postImageName;
	move_uploaded_file($imgInp["tmp_name"], $target_file);

	$sql = "INSERT into blogpost (posttitle, postcontent, postby, postimage) VALUES ('$postTitle', '$postContent', 'admin', '$postImageName')";
	$query = mysqli_query($connection,$sql);
	if($query){
		echo "<script>alert('Blog updated');location='manageblog.php';</script>";
	}else{
		echo "<script>alert('Something went wrong please try again after some times.');location='manageblog.php';</script>";
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
					<label class="ui header">Add / Edit Post</label>
					<form class="ui form" method="post" enctype="multipart/form-data">
						<?php
							if(strlen($_GET['poid'])>0)
							{
								$catid=intval($_GET['poid']);
								$sql = "SELECT * from blogpost where id=".$catid;
								$query = mysqli_query($connection,$sql);
								while($row=mysqli_fetch_array($query)){
						?>
							<div class="ui field">
								<label>Post Title</label>
								<input type="text" name="posttitle" placeholder="Post Title" value="<?php echo $row['posttitle']; ?>" required>
							</div>
							<div class="ui field">
								<label>Post</label>
								<textarea placeholder="Post Content" name="postcontent" required><?php echo $row['postcontent']; ?></textarea>
							</div>
							<div class="ui field">
								<label>Post Image</label>
								<input type="file" class="ui small fluid button" id="imgInp" name="imgInp" accept="image/x-png,image/gif,image/jpeg">
								<br><br>
								<img src="appimage/post/<?php echo $row['posttitle']."/".$row['postimage']; ?>" class="ui medium image" id="prodImgPre">
							</div>
							<div class="ui field" style="display: none;">
								<input type="text" name="postimage" id="postimage" value="<?php echo $row['postimage']; ?>">
								<input type="text" name="postid" value="<?php echo $catid; ?>">
							</div>
							<div class="ui field" align="center">
								<button type="submit" name="update" class="ui primary button">Update</button>	
							</div>
						<?php			
								}
							}else{
						?>
							<div class="ui field">
								<label>Post Title</label>
								<input type="text" name="posttitle" placeholder="Post Title" value="<?php echo $row['posttitle']; ?>" required>
							</div>
							<div class="ui field">
								<label>Post</label>
								<textarea placeholder="Post Content" name="postcontent" required><?php echo $row['postcontent']; ?></textarea>
							</div>
							<div class="ui field">
								<label>Post Image</label>
								<input type="file" class="ui small fluid button" id="imgInp" name="imgInp" accept="image/x-png,image/gif,image/jpeg" required>
								<br><br>
								<img class="ui medium image" id="prodImgPre">
							</div>
							<div class="ui field" style="display: none;">
								<input type="text" name="poid" value="">
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