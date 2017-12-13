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
</head>
<body>
	<?php include('includes/menu-bar.php');?>	
	<div class="pusher dimmed">
		<div class="ui center aligned page grid">
			<div class="row">
				<div class="column" >
					<label class="ui header" style="text-align: left;">My Account</label>					
				</div>
			</div>
			<div class="row section">
				<div class="column">
					<div class="ui seven stackable special link cards">
						<a class="ui card" href="bill-ship-addresses.php">
							<div class="ui center aligned image" style="width: 100%;">
								<i class="user icon large card_icon"></i>
							</div>
							<div class="content">
								<div class="card header">
									Change Billing Address
								</div>
							</div>
						</a>
						<a class="ui card" href="trackorder.php">
							<div class="ui center aligned image" style="width: 100%;">
								<i class="shipping large icon card_icon"></i>
							</div>
							<div class="content">
								<div class="card header">
									Track Order
								</div>
							</div>
						</a>
					</div>
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