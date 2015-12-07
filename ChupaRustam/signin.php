<?php
include_once("common_code/userdb.inc.php");
session_start();
$user = $_REQUEST['uname'];
$pass = $_REQUEST['password'];
$res = $mysqli->query("SELECT upass FROM merchant_login WHERE uname = '$user'");
$row = $res->fetch_assoc();
if($pass===$row['upass'])
{
    session_start();
    $_SESSION['uname'] = $user;	
   header('Location: my-outlets.php');
    }
else
{
		$_SESSION['loginerror'] = "Invalid UserName or Password ";
		header('Location:./index.php');
    }
?>