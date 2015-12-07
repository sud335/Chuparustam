<?php
include_once("common_code/userdb.inc.php");
session_start();
if(!(empty($_SESSION['uname'])))
{
	$user =  $_SESSION['uname'];
	$result = mysqli_query($mysqli,"SELECT * FROM merchant_login WHERE uname = '$user'");
	while($row = mysqli_fetch_array($result))
	{
            $mid = $row['merchant_id'];
              $role=$row['role'];
	}
    $offerid=$_REQUEST['id'];
    $slaveid=$_REQUEST['sid'];
   // echo $offerid,$slaveid;
	$q="Delete from merchant_offers where offer_id='$offerid' and merchant_id='$slaveid'";
//	echo $q;
	$sqlslaveinsert=mysqli_query($userdb,$q);
	if($sqlslaveinsert)echo"true";else echo"false";
	$q="Delete from offer_at_outlets where offer_id='$offerid' and slave_id='$slaveid'";
//	echo $q;
	$sqlslaveinsert=mysqli_query($userdb,$q);
	if($sqlslaveinsert)echo"true2";else echo"false2";



}
header('location: offers.php');
?>