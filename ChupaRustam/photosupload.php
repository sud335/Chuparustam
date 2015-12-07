 <?php 
include_once("common_code/userdb.inc.php");
$id = $_REQUEST['id'];
$role=$_REQUEST['role'];
echo $role;
//echo $id;
$valid_formats = array('jpeg', 'jpg', 'png','gif');
$max_file_size = 1024*1024*1;//max 1mb
$count = 0;
$target = "photos/";
 /*		$target = $target . basename( $_FILES['file']['name']) ; 
		$name = basename( $_FILES['file']['name']);
		if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) 
		{*/
 if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
 {
		foreach ($_FILES['files']['name'] as $f => $name) 
		{     
			if ($_FILES['files']['error'][$f] == 4) 
			{
				continue; // Skip file if any error found

			}
			if ($_FILES['files']['error'][$f] == 0) 
			{
				if ($_FILES['files']['size'][$f] > $max_file_size) 
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
			
					if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $target.$name))
						$count++; // Number of successfully uploaded file

					if($role==="SLAVE")
					{
						$query1="INSERT INTO `chuparustam`.`merchant_photos` (`picture_id` ,`merchant_id` ,`picture_name`)VALUES (NULL ,  '$id',  '$name')";
						$sql=mysqli_query($userdb,$query1);
						if($sql)echo"ok";
						else
						echo"no";
						$result = mysqli_query($mysqli,"SELECT * FROM merchant_photos WHERE merchant_id = '$id' AND picture_name = '$name'");
						while($row = mysqli_fetch_array($result))
						{			
							$picid=$row['picture_id'];
							//echo "\n";
							//echo $picid;
						}
				
						$query2="INSERT INTO  `chuparustam`.`photo_at_outlets` (`picture_id` ,`slave_id`)VALUES ('$picid',  '$id');";
						$sql=mysqli_query($userdb,$query2); 	     
					}
					elseif($role==="MASTER")
					{						
						$query1="INSERT INTO `chuparustam`.`merchant_photos` (`picture_id` ,`merchant_id` ,`picture_name`)VALUES (NULL ,  '$id',  '$name')";
						$sql=mysqli_query($userdb,$query1);	

						if($sql)echo"ok".$id." ";
						else
						echo"no";
						
						$result = mysqli_query($mysqli,"SELECT * FROM merchant_photos WHERE merchant_id = '$id' AND picture_name = '$name'");
						while($row = mysqli_fetch_array($result))
						{			
							$picid=$row['picture_id'];
							echo "\n";
							echo $picid;
						}						
						
						
						
						$result = mysqli_query($mysqli,"SELECT * FROM merchant_slave WHERE master_id = '$id'");						
						while($row = mysqli_fetch_array($result))
						{		
								$sid=$row['slave_id'];			
								$query2="INSERT INTO  `chuparustam`.`photo_at_outlets` (`picture_id` ,`slave_id`)VALUES ('$picid',  '$sid');";
								$sql=mysqli_query($userdb,$query2); 								
								
						}
					}
	 
					echo $count;
				}
			}
		}
	header('Location:photos.php');
}
 else {
 echo "Sorry, there was a problem uploading your file.";
 }




 ?> 

