<?php 
include('includes/config.php');
include('includes/cred.php');
include('includes/Instamojo.php');
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
$error=false;
$paymentMethod=null;
// code for insert product in order table
if((isset($_POST['ordersubmit']))&&($_POST['paymode']=="cash"))
{
	$paymentMethod="Cash on Deliver";
}
if((isset($_POST['ordersubmit']))&&($_POST['paymode']=="online"))
{
	$paymentMethod="Online Payment";
	$instaDetail= array("X-Api-Key:".$Insta_API_KEY, "X-Auth-Token:".$Insta_AUTH_TOKEN);

	$sql = "SELECT * from orders order by id desc limit 1";
	$result=mysqli_query($connection,$sql);
	$price=0;
 	foreach($_SESSION['cart'] as $id => $value){
 		$price=$_SESSION['cart'][$id]['total']+$price;
 	}
 	echo $price;
	
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER,$instaDetail);
	$payload = Array(
		'purpose' => 'Order ',
		'amount' => '2500',
		'phone' => '9999999999',
		'buyer_name' => 'John Doe',
		'redirect_url' => 'http://www.example.com/redirect/',
		'send_email' => true,
		'webhook' => 'http://www.example.com/webhook/',
		'send_sms' => true,
		'email' => 'foo@example.com',
		'allow_repeated_payments' => false
	);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
	$response = curl_exec($ch);
	curl_close($ch); 

	echo $response;
}

// $sql = "SELECT * from users where id=".$_SESSION['id'];
// $result=mysqli_query($connection,$sql);
// if(!$result){
// 	echo "<script>alert('Session expired. Please Log-in again');location='login.php'; </script>";
// }
// else{
// 	$row = mysqli_fetch_array($result);
// }

// $omail = $row['email'];
// $oname = $row['name'];
// $oaddress = $row['shippingAddress']." ".$row['shippingCity']." ".$row['shippingState']." ".$row['shippingPincode'];				
// $ophone = $row['contactno'];
// $omailcontent=null;

// $omailcontent="<h2>Customer Name : ".$oname."<br> Delivery Address : ".$oaddress."<br>Contact Number : ".$ophone."<br> Order Time : ".$currentTime;

// $mail = new PHPMailer;
// $mail->isSMTP();
// $mail->Host = 'smtp.gmail.com';
// $mail->Port = 587;
// $mail->SMTPSecure = 'tls';
// $mail->SMTPAuth = true;
// $mail->Username = $mail_id;
// $mail->Password = $mail_pass;

// $sql = "SELECT * from users where id=".$_SESSION['id'];
// $result=mysqli_query($connection,$sql);
// $row = mysqli_fetch_array($result);


// // Email Sending Details
// $mail->setFrom($omail, $oname);
// $mail->addAddress('aravinda.narayanan@xoanonanalytics.com','aravind');
// $mail->Subject = "Order";

// foreach($_SESSION['cart'] as $id => $value){
// 	$quantity=$_SESSION['cart'][$id]['quantity'];
// 	$size=$_SESSION['cart'][$id]['size'];
// 	$pdd=$id;
// 	$sql = "insert into orders(userId,productId,quantity,size) values('".$_SESSION['id']."','$pdd','$quantity','$size')";
// 	if(!$sql){
// 		$error_msg="Internal Error. Order not placed";
// 		$error=true;
// 	}
// 	$omailcontent=$omailcontent."<br> Product Id: ".$pdd."<br> Product Quantity: ".$quantity."<br> Size: ".$size;
// 	mysqli_query($connection,$sql);
// }
// $omailcontent=$omailcontent." </h2>";
// $mail->msgHTML($omailcontent);
// if (!$mail->send()) {
// 	$error = "Mailer Error: " . $mail->ErrorInfo;
// 	$result = $error;
// }
// else {
// 	$result = 'Mail sent!';
// }
// echo "<script>alert('Order Placed Successfully');</script>";
// unset($_SESSION['cart']);
?>
