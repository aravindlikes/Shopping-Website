<?php 
include('includes/config.php');
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(strlen($_SESSION['login'])==0){   
	header('location:login.php');
}
// code for insert product in order table
if((isset($_POST['ordersubmit']))&&($_POST['paymode']=="cash"))
{
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = 'aravindanarayanan.m@gmail.com';
	$mail->Password = 'aravindlove';

	$sql = "SELECT * from users where id=".$_SESSION['id'];
	$result=mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($result);

	$omail = $row['email'];
	$oname = $row['name'];
	$oaddress = $row['shippingAddress']." ".$row['shippingCity']." ".$row['shippingState']." ".$row['shippingPincode'];				
	$ophone = $row['contactno'];
	$omailcontent=null;

	// Email Sending Details
	$mail->setFrom($omail, $oname);
	$mail->addAddress('aravinda.narayanan@xoanonanalytics.com','aravind');
	$mail->Subject = "Order";
	$omailcontent="<h2>Customer Name : ".$oname."<br> Delivery Address : ".$oaddress."<br>Contact Number : ".$ophone."<br> Order Time : ".$currentTime;

	foreach($_SESSION['cart'] as $id => $value){
		$quantity=$_SESSION['cart'][$id]['quantity'];
		$size=$_SESSION['cart'][$id]['size'];
		$pdd=$id;
		$sql = "insert into orders(userId,productId,quantity,size) values('".$_SESSION['id']."','$pdd','$quantity','$size')";
		$omailcontent=$omailcontent."<br> Product Id: ".$pdd."<br> Product Quantity: ".$quantity."<br> Size: ".$size;
		mysqli_query($connection,$sql);
	}
	$omailcontent=$omailcontent." </h2>";
	$mail->msgHTML($omailcontent);
	if (!$mail->send()) {
		$error = "Mailer Error: " . $mail->ErrorInfo;
		$result = $error;
	}
	else {
		$result = 'Mail sent!';
	}
	echo "<script>alert('Order Placed Successfully');</script>";
	unset($_SESSION['cart']);
}
if((isset($_POST['ordersubmit']))&&($_POST['paymode']=="online"))
{
	
}
?>
