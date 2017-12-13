<?php
include('includes/config.php');
error_reporting(0);
if((strlen($_SESSION['login'])))
{
	echo "<script>alert('Already Logged in...');location='my-cart.php';</script>";
}
// Code for User login
$status=0;
if(isset($_POST['login']))
{
	$email=$_POST['umail'];
	$password=$_POST['upassword'];
	$sql="SELECT * FROM users WHERE email='$email' and password='$password'";
	$query=mysqli_query($connection,$sql);
	$num=mysqli_fetch_array($query);
	if($num>0)
	{
		$extra=$_GET['redirect'];
		$_SESSION['login']=$_POST['umail'];
		$_SESSION['id']=$num['id'];
		$_SESSION['username']=$num['name'];
		$uip=$_SERVER['REMOTE_ADDR'];
		$status=1;
		$sql="INSERT into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')";
		$log=mysqli_query($connection,$sql);
		$_SESSION['logerrmsg']=="Login successfully";
		$host=$_SERVER['HTTP_HOST'];
		$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
	}
	else
	{
		$extra="login.php";
		$email=$_POST['umail'];
		$uip=$_SERVER['REMOTE_ADDR'];
		$status=0;
		$sql="INSERT into userlog(userEmail,userip,status) values('$email','$uip','$status')";
		$log=mysqli_query($connection,$sql);
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
	}
	if($status==0){
		$_SESSION['logerrmsg']="Invalid email id or Password";
		echo "<script>alert('Invalid email id or Password');location='login.php';</script>";
	} else{
		$_SESSION['logerrmsg']="Login successfully";
		echo "<script>alert('Login successfully');location='my-cart.php';</script>";
	}	
}
if(isset($_POST['register']))
{
	$name=$_POST['uname'];
	$email=$_POST['umail'];
	$contactno=$_POST['uphone'];
	$password=$_POST['upassword'];
	$address=$_POST['uaddress'];
	$city=$_POST['ucity'];
	$state=$_POST['ustate'];
	$pincode=$_POST['upin'];

	$sql="SELECT * FROM users WHERE email='$email'";	
	$query=mysqli_query($connection,$sql);
	if(mysqli_num_rows($query)>0){
		echo "<script>alert('Mail-id already registered');</script>";
	}elseif (($name=="")&&($email=="")&&($contactno=="")&&($password=="")&&($address=="")&&($city=="")&&($state=="")&&($pincode=="")){
		echo "<script>alert('Enter All fields');</script>";
	}else {
		$sql="INSERT into users(name,email,contactno,password,shippingAddress,shippingState,shippingCity,shippingPincode) values('$name','$email','$contactno','$password','$address','$state','$city','$pincode')";
		$query = mysqli_query($connection,$sql);
		if($query)
		{
			echo "<script>alert('You are successfully registered');</script>";
		}
		else{
			echo "<script>alert('Not register something went worng');</script>";
		}		
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
	<link rel="stylesheet" href="assets/semantic-ui/dist/semantic.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">

	<script type="text/javascript" src="assets/jquery/jquery.js"></script>
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
						<div class="item" data-tab="register">Register</div>
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
					<div class="ui bottom attached tab" data-tab="register">
						<form class="ui form" method="post">
							<div class="required field">
								<label>Name</label>
								<input type="text" name="uname" id="uname" placeholder="User Name" required>
							</div>
							<div class="required field">
								<label>Email-id</label>
								<input type="email" name="umail" id="umail" placeholder="example@abc.com" required>
							</div>
							<div class="required field">
								<label>Phone</label>
								<input type="number" name="uphone" id="uphone" placeholder="9876501234" required>
							</div>
							<div class="required field">
								<label>Address</label>
								<input type="text" name="uaddress" id="uaddress" placeholder="Address" required>
							</div>
							<div class="required field">
								<label>State</label>
								<input type="text" name="ustate" id="ustate" placeholder="State" required>
							</div>
							<div class="required field">
								<label>City</label>
								<input type="text" name="ucity" id="ucity" placeholder="City" required>
							</div>
							<div class="required field">
								<label>Pin Code</label>
								<input type="number" name="upin" id="upin" placeholder="Pin Code" required>
							</div>							
							<div class="required field">
								<label>Password</label>
								<input type="password" name="upassword" id="upassword" placeholder="Password" required>
							</div>
							<div class="field" align="right">
								<button type="submit" name="register" class="ui primary button">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="assets/semantic-ui/dist/semantic.js"></script>
	<script type="text/javascript" src="assets/js/owl.carousel.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>	
</body>
</html>		