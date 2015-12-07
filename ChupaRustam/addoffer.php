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
	if (isset($_REQUEST['submit']))
	{

		//assuming the role is master
		if($role==='MASTER')
		{

			$description=$_REQUEST['description'];
			$terms=$_REQUEST['terms'];
			$expiry=$_REQUEST['expiry'];
			if(isset($_REQUEST['category']))
			{
				////echo 'category found';
				$j = 1;
				foreach($_REQUEST['category'] as $value)
				{	
					$day[$j] = $value;
					$j++;
				}
				$columns2 = implode(",",array_keys($day));
				$escaped_values2 = array_map('mysql_real_escape_string', array_values($day));
				$values2  = implode(",", $escaped_values2);
			}		//category close
	
			if (isset($_REQUEST['exclusive']))
			{
				$exclusive=intval($_REQUEST['exclusive']);	
			}
			else
				$exclusive=0;		
			////echo $exclusive,$values2,$expiry,$terms,$description;
			if(isset($_REQUEST['outlet']))
			{
				//echo"i am here";
				$result = mysqli_query($mysqli,"SELECT * FROM merchant_slave WHERE master_id = '$mid'");
				while($row = mysqli_fetch_array($result))
				{
					$value=$row['slave_id'];
					$query1="INSERT INTO `chuparustam`.`merchant_offers` ( `merchant_id`,`offer_desc`, `offer_categorie`, `exclusive`, `expiry`,`terms`) VALUES ( '$value','$description', '$values2', '$exclusive', '$expiry','$terms');";
					$sqlslaveinsert=mysqli_query($userdb,$query1);
					$query2="SELECT `offer_id` FROM `merchant_offers` WHERE `merchant_id`='$value' and`offer_desc`='$description' and `offer_categorie`='$values2' and `exclusive`='$exclusive' and `expiry`='$expiry' and`terms`='$terms'";
					$res1 = $mysqli->query($query2);
					while( $row1 = $res1->fetch_assoc())
                    {
                                 $offerid= $row1['offer_id'];
					}
					$offerquery="INSERT INTO `chuparustam`.`offer_at_outlets`( `offer_id`,`slave_id`) VALUES ('$offerid','$value') ";
					$sqlslaveinsert=mysqli_query($userdb,$offerquery);
				}
				
			}			
			else if (isset($_REQUEST['outlets']))
			{
				////echo 'outlets found';
				$j = 1;
				foreach($_REQUEST['outlets'] as $value)
				{
					$query1="INSERT INTO `chuparustam`.`merchant_offers` ( `merchant_id`,`offer_desc`, `offer_categorie`, `exclusive`, `expiry`,`terms`) VALUES ( '$value','$description', '$values2', '$exclusive', '$expiry','$terms');";
					$sqlslaveinsert=mysqli_query($userdb,$query1);
					$query2="SELECT `offer_id` FROM `merchant_offers` WHERE `merchant_id`='$value' and`offer_desc`='$description' and `offer_categorie`='$values2' and `exclusive`='$exclusive' and `expiry`='$expiry' and`terms`='$terms'";
					$res1 = $mysqli->query($query2);
					while( $row1 = $res1->fetch_assoc())
                    {
                                 $offerid= $row1['offer_id'];
					}
					$offerquery="INSERT INTO `chuparustam`.`offer_at_outlets`( `offer_id`,`slave_id`) VALUES ('$offerid','$value') ";
					$sqlslaveinsert=mysqli_query($userdb,$offerquery);

				}//for close

			}
		}//role ends

		if($role==='SLAVE')
		{
				$description=$_REQUEST['description'];
				$terms=$_REQUEST['terms'];
				$expiry=$_REQUEST['expiry'];
				if(isset($_REQUEST['category']))
				{
					//echo 'category found';
					$j = 1;
					foreach($_REQUEST['category'] as $value)
					{	
						$day[$j] = $value;
						$j++;
					}
					$columns2 = implode(",",array_keys($day));
					$escaped_values2 = array_map('mysql_real_escape_string', array_values($day));
					$values2  = implode(",", $escaped_values2);
				}		//category close
				if (isset($_REQUEST['exclusive']))
				{
						$exclusive=intval($_REQUEST['exclusive']);	
				}
				else
					$exclusive=0;
					//echo $description,$terms,$exclusive,$expiry,$values2,$mid;
				$query1="INSERT INTO `chuparustam`.`merchant_offers` ( `merchant_id`,`offer_desc`, `offer_categorie`, `exclusive`, `expiry`,`terms`) VALUES ( '$mid','$description', '$values2', '$exclusive', '$expiry','$terms');";
				$sqlslaveinsert=mysqli_query($userdb,$query1);
		}
	}//submit ends
}// uname ends
header('location: offers.php');
?>