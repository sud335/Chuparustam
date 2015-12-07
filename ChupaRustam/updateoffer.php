<?php
include_once("common_code/userdb.inc.php");
session_start();
$user =  $_SESSION['uname'];
$result = mysqli_query($mysqli,"SELECT * FROM merchant_login WHERE uname = '$user'");
while($row = mysqli_fetch_array($result))
{
$mid = $row['merchant_id'];
$role=$row['role'];
}
if(!(empty($_SESSION['uname'])))
{
	if (isset($_REQUEST['save']))
	{
		//if($role=="SLAVE")
		//{
			$description=$_REQUEST['description'];
	
			$slaveid=$_REQUEST['slave_id'];
			echo $slaveid;
				if(isset($_REQUEST['category']))
				{
					
					$j = 1;
					foreach($_REQUEST['category'] as $value)
					{	
						$day[$j] = $value;
						$j++;
					}
					$columns2 = implode(",",array_keys($day));
					$escaped_values2 = array_map('mysql_real_escape_string', array_values($day));
					$values2  = implode(",", $escaped_values2);
				}
			
				$expiry=$_REQUEST['expiry'];
				
				if (isset($_REQUEST['exclusive']))
				{
					$exclusive=intval($_REQUEST['exclusive']);	
				}
				else
				$exclusive=0;
				$terms=$_REQUEST['terms'];
				$slaveid=intval($slaveid);
	
				$q = "UPDATE merchant_offers SET offer_desc='$description' WHERE offer_id = '$slaveid' ";
				$query = mysqli_query($mysqli,$q);
				$q = "UPDATE merchant_offers SET offer_categorie='$values2' WHERE offer_id = '$slaveid' ";
				echo $q;
				$query = mysqli_query($mysqli,$q);
				$q = "UPDATE merchant_offers SET exclusive='$exclusive' WHERE offer_id = '$slaveid' ";
				$query = mysqli_query($mysqli,$q);
				$q = "UPDATE merchant_offers SET expiry='$expiry' WHERE offer_id = '$slaveid' ";
				$query = mysqli_query($mysqli,$q);
				$q = "UPDATE merchant_offers SET terms='$terms' WHERE offer_id = '$slaveid' ";
				$query = mysqli_query($mysqli,$q);
		//}
	}//save endss

}//uname ends

header('location: offers.php');
?>