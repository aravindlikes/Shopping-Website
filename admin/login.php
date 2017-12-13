<?php
include('../includes/config.php');
error_reporting(0);
$status=0;
// Code for User login
if(isset($_POST['login']))
{
	$email=$_POST['umail'];
	$password=$_POST['upassword'];
	$sql="SELECT * FROM admin WHERE username='$email' and password='$password'";
	$query=mysqli_query($connection,$sql);
	$num=mysqli_fetch_array($query);
	if($num>0)
	{
		$_SESSION['alogin']=$_POST['umail'];
		$_SESSION['id']=$num['id'];
		$_SESSION['username']=$num['username'];
		$status=1;
		$extra="login.php";
		$uip=$_SERVER['REMOTE_ADDR'];
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		$_SESSION['logerrmsg']="Login successfully";
		echo "<script>alert('Login successfully');location='index.php';</script>";
	}
	else{
		$_SESSION['logerrmsg']="Invalid email id or Password";
		echo "<script>alert('Invalid email id or Password');location='login.php';</script>";		
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
			<div class="row section">
				<div class="four wide column">
				</div>
				<div class="eight wide column">
					<div class="ui top tabular menu">
						<div class="active item" data-tab="login">Login</div>
					</div>
					<div class="ui bottom attached active tab" data-tab="login">
						<form class="ui form" method="post">
							<div class="required field">
								<label>Email-id</label>
								<input type="email" name="umail" id="umail">
							</div>
							<div class="required field">
								<label>Password</label>
								<input type="password" name="upassword" id="upassword">
							</div>
							<div class="field" align="right">
								<button type="submit" name="login" class="ui primary button">Login</button>
							</div>
						</form>
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