<?php
include_once("common_code/userdb.inc.php");
session_start();
if(!(empty($_SESSION['uname'])))
{

		if (isset($_REQUEST['submit']))
		{ 
			$slavename=$_REQUEST['slavename'];
			$address=$_REQUEST['address'];	
			$contact=$_REQUEST['contact'];
			$email=$_REQUEST['email'];
			$datepicker1=$_REQUEST['datetimepicker1'];
			$datepicker2=$_REQUEST['datetimepicker2'];
			$slaveid=$_REQUEST['slaveid'];
		
			//echo $slaveid;
			//echo "hshshshhshshshs"    ;
			//echo $datepicker1,$datepicker2,$slaveid;
			if(isset($_REQUEST['day']))
			{
				echo 'day found';
				$j = 1;
				foreach($_REQUEST['day'] as $value)
				{	
					$day[$j] = $value;
					$j++;
				}	
				$columns2 = implode(",",array_keys($day));
				$escaped_values2 = array_map('mysql_real_escape_string', array_values($day));
				$values2  = implode(",", $escaped_values2);
							
			}		//day close
			$categoryidentifier=$_REQUEST['categoryidentifier'];
			echo $categoryidentifier;
			//echo $values2,$slavename,$address,$contact,$email;
			
			if($categoryidentifier==="APPAREL")
			{		
					//save in category_apparel
					////echo 'apparel';
					if(isset($_REQUEST['men']))
					{
						////echo 'men found';
						$j = 1;
						foreach($_REQUEST['men'] as $value1)
						{	
							$men[$j] = $value1;
							$j++;
						}
						$columns21 = implode(",",array_keys($men));
						$escaped_values21 = array_map('mysql_real_escape_string', array_values($men));
						$values21  = implode(",", $escaped_values21);
						//echo $values21;
					}
					else
					{
						$values21=NULL;
					}

					if(isset($_REQUEST['women']))
					{
							//echo 'women found';
							$j = 1;
							foreach($_REQUEST['women'] as $value2)
							{	
									$women[$j] = $value2;
									$j++;
							}
							$columns213 = implode(",",array_keys($women));
							$escaped_values213 = array_map('mysql_real_escape_string', array_values($women));
							$values213  = implode(",", $escaped_values213);
							//echo $values213;
					}
					else
					{
							$values213=NULL;
					}

					if(isset($_REQUEST['kid']))
					{
						//echo 'kid found';
						$j = 1;
						foreach($_REQUEST['kid'] as $value3)
						{	
							$kid[$j] = $value3;
							$j++;
						}
						$columns214 = implode(",",array_keys($kid));
						$escaped_values214 = array_map('mysql_real_escape_string', array_values($kid));
						$values214  = implode(",", $escaped_values214);
						//echo $values214;
					}
					else{
						$values214=NULL;
					}


					$checkquery1="Select * from category_apparel where slave_id = '$slaveid'";
					if($query_run=mysql_query($checkquery1))
					{
						if(mysql_num_rows($query_run)==NULL)
						{	
							//echo 'new addition';
							$query1="INSERT INTO `chuparustam`.`category_apparel` ( `slave_id`,`men`, `women`, `kids`, `closed_days`,`open_time`,`close_time`) VALUES ( '$slaveid','$values21', '$values213', '$values214', '$values2','$datepicker1','$datepicker2');";
							$sqlslaveinsert=mysqli_query($userdb,$query1);
						}
					}
					else{
							if(isset($slavename))
								$q="UPDATE  `chuparustam`.`merchant_slave` SET  `name` =  '$slavename' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							if(isset($address))
								$q="UPDATE  `chuparustam`.`merchant_slave` SET  `address` =  '$address' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							if(isset($contact))
								$q="UPDATE  `chuparustam`.`merchant_slave` SET  `contact` =  '$contact' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							if(isset($email))
								$q="UPDATE  `chuparustam`.`merchant_slave` SET  `email` =  '$email' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							if(isset($values21))
								$q="UPDATE  `chuparustam`.`category_apparel` SET  `men` =  '$values21' WHERE  `category_apparel`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							if(isset($values213))
								$q="UPDATE  `chuparustam`.`category_apparel` SET  `women` =  '$values213' WHERE  `category_apparel`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							if(isset($values214))
								$q="UPDATE  `chuparustam`.`category_apparel` SET  `kids` =  '$values214' WHERE  `category_apparel`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							if(isset($values2))
								$q="UPDATE  `chuparustam`.`category_apparel` SET  `closed_days` =  '$values2' WHERE  `category_apparel`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							if(isset($datepicker1))
								$q="UPDATE  `chuparustam`.`category_apparel` SET  `open_time` =  '$datepicker1' WHERE  `category_apparel`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							if(isset($datepicker2))
								$q="UPDATE  `chuparustam`.`category_apparel` SET  `close_time` =  '$datepicker2' WHERE  `category_apparel`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
						}



   
			}//apparel ka if
    
			else if($categoryidentifier==="FOOD")
			{	//save in category_food

					//echo 'food';
					if(isset($_REQUEST['availoption']))
					{
							//echo 'availoption found';
							$j = 1;
							foreach($_REQUEST['availoption'] as $value1)
							{	
								$availoption[$j] = $value1;
								$j++;
							}
							$columns21 = implode(",",array_keys($availoption));
							$escaped_values21 = array_map('mysql_real_escape_string', array_values($availoption));
							$values21  = implode(",", $escaped_values21);
							//echo $values21;
					}else{
					$values21=NULL;
					}

					if(isset($_REQUEST['highlights']))
					{
							//echo 'highlights found';
							$j = 1;
							foreach($_REQUEST['highlights'] as $value2)
							{	
								$highlights[$j] = $value2;
								$j++;
							}
							$columns213 = implode(",",array_keys($highlights));
							$escaped_values213 = array_map('mysql_real_escape_string', array_values($highlights));
							$values213  = implode(",", $escaped_values213);
							//echo $values213;
					}else
					{
							$values213=NULL;
					}
					if(isset($_REQUEST['recommendoptions']))
					{
							$recommendations=$_REQUEST['recommendoptions'];
							//echo $recommendations;
					}else{
							$recommendations=NULL;
					}
					$checkquery1="Select * from category_food where slave_id = '$slaveid'";
					if($query_run=mysql_query($checkquery1))
					{
							if(mysql_num_rows($query_run)==NULL)
							{	
								//echo 'new addition';
								$query1="INSERT INTO `chuparustam`.`category_food` ( `slave_id`,`sub_categorie`, `highlights`, `recommended_dish`,`closed_days`,`open_time`,`close_time`) VALUES ( '$slaveid','$values21', '$values213','$recommendations', '$values2','$datepicker1','$datepicker2');";
								$sqlslaveinsert=mysqli_query($userdb,$query1);
							}
					}
					else
					{
							$q="UPDATE  `chuparustam`.`merchant_slave` SET  `name` =  '$slavename' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							$q="UPDATE  `chuparustam`.`merchant_slave` SET  `address` =  '$address' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							$q="UPDATE  `chuparustam`.`merchant_slave` SET  `contact` =  '$contact' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							$q="UPDATE  `chuparustam`.`merchant_slave` SET  `email` =  '$email' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							$q="UPDATE  `chuparustam`.`category_food` SET  `sub_categorie` =  '$values21' WHERE  `category_food`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							$q="UPDATE  `chuparustam`.`category_food` SET  `highlights` =  '$values213' WHERE  `category_food`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							$q="UPDATE  `chuparustam`.`category_food` SET  `recommended_dish` =  '$recommendations' WHERE  `category_food`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							$q="UPDATE  `chuparustam`.`category_food` SET  `closed_days` =  '$values2' WHERE  `category_food`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							$q="UPDATE  `chuparustam`.`category_food` SET  `open_time` =  '$datepicker1' WHERE  `category_food`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
							$q="UPDATE  `chuparustam`.`category_food` SET  `close_time` =  '$datepicker2' WHERE  `category_food`.`slave_id` ='$slaveid';";
							$sqlslaveinsert=mysqli_query($userdb,$q);
					}
				echo "i am here";
			}//food close
else if($categoryidentifier==="GROOMING"){	//save in category_wellness

//echo 'grooming';
	if(isset($_REQUEST['sub_category']))
	{
	//echo 'sub_category found';
	$j = 1;
	foreach($_REQUEST['sub_category'] as $value1)
	{	
		$sub_category[$j] = $value1;
		$j++;
	}
	$columns21 = implode(",",array_keys($sub_category));
	$escaped_values21 = array_map('mysql_real_escape_string', array_values($sub_category));
	$values21  = implode(",", $escaped_values21);
	//echo $values21;
	}else{
		$values21=NULL;
	}

	if(isset($_REQUEST['subsub_category']))
	{
	//echo 'subsub_category found';
	$j = 1;
	foreach($_REQUEST['subsub_category'] as $value2)
	{	
		$subsub_category[$j] = $value2;
		$j++;
	}
	$columns213 = implode(",",array_keys($subsub_category));
	$escaped_values213 = array_map('mysql_real_escape_string', array_values($subsub_category));
	$values213  = implode(",", $escaped_values213);
	//echo $values213;
	}else{
		$values213=NULL;
	}

$checkquery1="Select * from category_wellness where slave_id = '$slaveid'";
if($query_run=mysql_query($checkquery1))
{
	if(mysql_num_rows($query_run)==NULL)
	{	
		//echo 'new addition';
$query1="INSERT INTO `chuparustam`.`category_wellness` ( `slave_id`,`sub_categorie`, `sub_sub_categorie`, `closed_days`,`open_time`,`close_time`) VALUES ( '$slaveid','$values21', '$values213', '$values2','$datepicker1','$datepicker2');";
$sqlslaveinsert=mysqli_query($userdb,$query1);
}
}
else{
$q="UPDATE  `chuparustam`.`merchant_slave` SET  `name` =  '$slavename' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
$sqlslaveinsert=mysqli_query($userdb,$q);
$q="UPDATE  `chuparustam`.`merchant_slave` SET  `address` =  '$address' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
$sqlslaveinsert=mysqli_query($userdb,$q);
$q="UPDATE  `chuparustam`.`merchant_slave` SET  `contact` =  '$contact' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
$sqlslaveinsert=mysqli_query($userdb,$q);
$q="UPDATE  `chuparustam`.`merchant_slave` SET  `email` =  '$email' WHERE  `merchant_slave`.`slave_id` ='$slaveid';";
$sqlslaveinsert=mysqli_query($userdb,$q);
$q="UPDATE  `chuparustam`.`category_wellness` SET  `sub_categorie` =  '$values21' WHERE  `category_wellness`.`slave_id` ='$slaveid';";
$sqlslaveinsert=mysqli_query($userdb,$q);
$q="UPDATE  `chuparustam`.`category_wellness` SET  `sub_sub_categorie` =  '$values213' WHERE  `category_wellness`.`slave_id` ='$slaveid';";
$sqlslaveinsert=mysqli_query($userdb,$q);

$q="UPDATE  `chuparustam`.`category_wellness` SET  `closed_days` =  '$values2' WHERE  `category_wellness`.`slave_id` ='$slaveid';";
$sqlslaveinsert=mysqli_query($userdb,$q);
$q="UPDATE  `chuparustam`.`category_wellness` SET  `open_time` =  '$datepicker1' WHERE  `category_wellness`.`slave_id` ='$slaveid';";
$sqlslaveinsert=mysqli_query($userdb,$q);
$q="UPDATE  `chuparustam`.`category_wellness` SET  `close_time` =  '$datepicker2' WHERE  `category_wellness`.`slave_id` ='$slaveid';";
$sqlslaveinsert=mysqli_query($userdb,$q);
}



	

//echo 'suc';
}
}		//submit     
}		//uname




if(isset($_FILES['file']['name'])){
 $target = "logo/";
 $target = $target . basename( $_FILES['file']['name']) ; 
 $name = basename( $_FILES['file']['name']);
echo $name;
 if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) 
 {
    $query1="UPDATE `merchant_slave` SET `logo`='$name' where `slave_id`='$slaveid'";
     
	$sql=mysqli_query($userdb,$query1); 
     echo $query1;
     
//header('Location:info.php');
	 

 } 
 else {
 echo "Sorry, there was a problem uploading your file.";
 }    


}


$valid_formats = array('jpeg', 'jpg', 'png','gif');
$max_file_size = 1024*1024*1;//max 1mb
$count = 0;
$target = "images/upload/";

 if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
 {
	if($categoryidentifier==="FOOD")	
	{
		foreach ($_FILES['img1']['name'] as $f => $name) 
		{     
			if ($_FILES['img1']['error'][$f] == 4) 
			{
				continue; // Skip file if any error found

			}
			if ($_FILES['img1']['error'][$f] == 0) 
			{
				if ($_FILES['img1']['size'][$f] > $max_file_size) 
				{
					$message[] = "$name is too large!.";
					echo $message;
					continue; // Skip large files
				}

				else if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) )
				{
					$message[] = "$name is not a valid format";
					echo $message;
					continue; // Skip invalid file formats
				}
			
				else
				{
					
					
					if(move_uploaded_file($_FILES["img1"]["tmp_name"][$f], $target.$name))
						$count++;
					if($count===1)
					{
						$q="DELETE FROM `chuparustam`.`menu_ratelist` WHERE `menu_ratelist`.`slave_id` ='$slaveid' AND `menu_ratelist`.`type`='FOOD'";
						$sqldel=mysqli_query($userdb,$q);					
						if($sqldel)
						echo"ok";
						else
						echo"no";
					}
					
					 
					echo $categoryidentifier;	
					$query12="INSERT INTO `menu_ratelist`(`slave_id`,`pic`,`type`) VALUES ('$slaveid','$name','FOOD')";
					 
					 $sql=mysqli_query($userdb,$query12); 
					if($sql)
					echo"done" ;
						else 
					echo"not done";
					echo $query12;
				}

			echo $count;
			}
		}
		
		$count=0;
		foreach ($_FILES['img3']['name'] as $f => $name) 
		{     
			if ($_FILES['img3']['error'][$f] == 4) 
			{
				continue; // Skip file if any error found

			}
			if ($_FILES['img3']['error'][$f] == 0) 
			{
				if ($_FILES['img3']['size'][$f] > $max_file_size) 
				{
					$message[] = "$name is too large!.";
					echo $message;
					continue; // Skip large files
				}

				else if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) )
				{
					$message[] = "$name is not a valid format";
					echo $message;
					continue; // Skip invalid file formats
				}
			
				else
				{
			
					if(move_uploaded_file($_FILES["img3"]["tmp_name"][$f], $target.$name))
						$count++;
					if($count===1)
					{
						$q="DELETE FROM `chuparustam`.`menu_ratelist` WHERE `menu_ratelist`.`slave_id` ='$slaveid' AND `menu_ratelist`.`type`='BAR'";
						$sqldel=mysqli_query($userdb,$q);					
						if($sqldel)
						echo"ok";
						else
						echo"no";
					}					 
					echo $categoryidentifier;	
					$query12="INSERT INTO `menu_ratelist`(`slave_id`,`pic`,`type`) VALUES ('$slaveid','$name','BAR')";
					 
					 $sql=mysqli_query($userdb,$query12); 
					if($sql)
					echo"done" ;
						else 
					echo"not done";
					echo $query12;
				}

			echo $count;
			}
		}
	}
    else if($categoryidentifier==="GROOMING")	
	{	$count=0;
		foreach ($_FILES['img2']['name'] as $f => $name) 
		{     
			if ($_FILES['img2']['error'][$f] == 4) 
			{
				continue; // Skip file if any error found

			}
			if ($_FILES['img2']['error'][$f] == 0) 
			{
				if ($_FILES['img2']['size'][$f] > $max_file_size) 
				{
					$message[] = "$name is too large!.";
					echo $message;
					continue; // Skip large files
				}

				else if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) )
				{
					$message[] = "$name is not a valid format";
					echo $message;
					continue; // Skip invalid file formats
				}
			
				else
				{
			
					if(move_uploaded_file($_FILES["img2"]["tmp_name"][$f], $target.$name))
						$count++;
					if($count===1)
					{
						$q="DELETE FROM `chuparustam`.`menu_ratelist` WHERE `menu_ratelist`.`slave_id` ='$slaveid' AND `menu_ratelist`.`type`='RATELIST'";
						$sqldel=mysqli_query($userdb,$q);					
						if($sqldel)
						echo"ok";
						else
						echo"no";
					}					
					echo $categoryidentifier;	
					$query12="INSERT INTO `menu_ratelist`(`slave_id`,`pic`,`type`) VALUES ('$slaveid','$name','RATELIST')";
					 
					 $sql=mysqli_query($userdb,$query12); 
					if($sql)
					echo"done" ;
						else 
					echo"not done";
					echo $query12;
				}

			echo $count;
			}
		}
	}
}








header('location: my-outlets.php');

?>