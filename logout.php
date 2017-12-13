<?php
include("includes/config.php");
date_default_timezone_set('Asia/Kolkata');
$ldate=date( 'd-m-Y h:i:s A', time () );
$sql="UPDATE userlog  SET logout = '$ldate' WHERE userEmail = '".$_SESSION['login']."' ORDER BY id DESC LIMIT 1";
$result = mysqli_query($connection,$sql);
$_SESSION['login']=="";
$_SESSION['errmsg']="You have successfully logout";
session_unset();
echo "<script>alert('You have successfully logout');location='index.php';</script>";
?>