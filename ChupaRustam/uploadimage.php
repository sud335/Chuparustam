 <?php 
include_once("common_code/userdb.inc.php");
$id = $_REQUEST['id'];
$type=$_REQUEST['type'];
echo $type;
$target = "images/upload/";
/*$target = $target . basename( $_FILES['file']['name']) ; 
$name = basename( $_FILES['file']['name']);*/

$valid_formats = array('jpeg', 'jpg', 'png','gif');
$max_file_size = 1024*1024*1;//max 1mb
$count = 0;

/*if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) 
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


					//$query1="INSERT INTO merchant_photos(`merchant_id`,`picture_name`) VALUES ( '$id','$name')";
					//$sql=mysqli_query($userdb,$query1);
					$query2="INSERT INTO menu_ratelist(`slave_id`,`pic`,`type`) VALUES ( '$id','$name','$type')";
					$sql=mysqli_query($userdb,$query2);
						if($sql)echo"ok".$id." ";
						else
						echo"no";					
				}
     
			}
		}
}
			
	header('Location:info.php');
	 





 ?> 

