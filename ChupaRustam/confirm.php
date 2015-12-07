<?php
include_once("common_code/userdb.inc.php");
$offer_id = $_GET['offer_id'];
$user_id = $_GET['user_id'];
echo $offer_id;
echo "<br>";
echo $user_id;

$q = "UPDATE offers_activated SET confirmed=1 WHERE user_id = '$user_id' AND offer_id='$offer_id'";
 $query = mysqli_query($mysqli,$q);



       date_default_timezone_set('Asia/Kolkata');
         $date = new DateTime();
           
$date = $date->format('Y-m-d H:i:s');
      

$q1 = "UPDATE offers_activated SET confirmed_at='$date' WHERE user_id = '$user_id' AND offer_id='$offer_id'";
 $query = mysqli_query($mysqli,$q1);

header('Location:redeem.php');

?>