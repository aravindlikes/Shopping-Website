<?php
include('../includes/config.php');
$_SESSION['alogin']=="";
session_unset();
echo "<script>alert('You have successfully logout');location='index.php';</script>";
?>