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

	<script type="text/javascript" src="../assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$("#preloader").show();
	</script>
</head>
<body>
	<?php include('includes/menu-bar.php');?>
	<div class="pusher">
		<div class="ui page vertically divided centered grid">
			<div class="row section">
				<div class="column">
					<br>
					<div class="ui menu top">
						<a class="active item" data-tab="ordermgmt">
							<i class="shop icon"></i>
							<label class="disp">Order Management</label>
						</a>
						<a class="item" data-tab="productmgmt">
							<i class="tags icon"></i>
							<label class="disp">Product Management</label>
						</a>
						<a class="item" data-tab="usermgmt">
							<i class="user icon"></i>
							<label class="disp">User Management</label>
						</a>
						<a class="item" data-tab="blogmgmt">
							<i class="newspaper icon"></i>
							<label class="disp">Blog Management</label>
						</a>
					</div>
					<br>
					<div class="ui active tab" data-tab="ordermgmt">
						<div class="ui seven stackable special link cards">
							<a class="ui card" href="pendingorders.php">
								<div class="ui center aligned image" style="width: 100%;">
									<i class="add to cart large icon card_icon"></i>
								</div>
								<div class="content">
									<div class="card header">
										Pending Orders
									</div>
								</div>
							</a>
							<a class="ui card" href="allorders.php">
								<div class="ui center aligned image" style="width: 100%;">
									<i class="shopping basket large icon card_icon"></i>
								</div>
								<div class="content">
									<div class="card header">
										All Orders
									</div>
								</div>
							</a>							
						</div>
					</div>
					<div class="ui tab" data-tab="productmgmt">
						<div class="ui seven stackable special link cards">
							<a class="ui card" href="managecategory.php">
								<div class="ui center aligned image" style="width: 100%;">
									<i class="sitemap large icon card_icon"></i>
								</div>
								<div class="content">
									<div class="card header">
										Manage Category
									</div>
								</div>
							</a>
							<a class="ui card" href="managesubcategory.php">
								<div class="ui center aligned image" style="width: 100%;">
									<i class="server large icon card_icon"></i>
								</div>
								<div class="content">
									<div class="card header">
										Manage Sub-Category
									</div>
								</div>
							</a>
							<a class="ui card" href="manageproducts.php">
								<div class="ui center aligned image" style="width: 100%;">
									<i class="in cart large icon card_icon"></i>
								</div>
								<div class="content">
									<div class="card header">
										Manage Product
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="ui tab" data-tab="usermgmt">
						<div class="ui seven stackable special link cards">
							<a class="ui card" href="manageusers.php">
								<div class="ui center aligned image" style="width: 100%;">
									<i class="users large icon card_icon"></i>
								</div>
								<div class="content">
									<div class="card header">
										User Management
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="ui tab" data-tab="blogmgmt">
						<div class="ui seven stackable special link cards">
							<a class="ui card" href="manageblog.php">
								<div class="ui center aligned image" style="width: 100%;">
									<i class="newspaper large icon card_icon"></i>
								</div>
								<div class="content">
									<div class="card header">
										Blog Management
									</div>
								</div>
							</a>
						</div>
					</div>
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