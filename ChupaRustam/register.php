<?php
include_once("common_code/userdb.inc.php");

$user = $_REQUEST['uname'];
$pass = $_REQUEST['password'];
$name = $_REQUEST['cname'];
$number = $_REQUEST['number'];
$email = $_REQUEST['email'];
$category = $_REQUEST['category'];

$role="MASTER";

$sql=mysqli_query($userdb,"INSERT into merchant_login(uname,upass,role) VALUES ('$user','$pass','$role')");

$res = $mysqli->query("SELECT merchant_id FROM merchant_login WHERE uname = '$user'");
$row = $res->fetch_assoc();

$mid=$row['merchant_id'];
$active = 1;
$sql=mysqli_query($userdb,"INSERT into merchant_master(master_id,categorie,propriety_name,email,cp_phone,active) VALUES ('$mid','$category','$name','$email','$number','$active')");

header('Location:index.php');

?>