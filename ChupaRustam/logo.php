 <?php 
include_once("common_code/userdb.inc.php");
$id = $_REQUEST['id'];
$role = $_REQUEST['role'];
if($role==='MASTER'){
$table="merchant_master";
    $tid = "master_id";
    
}
if($role==='SLAVE'){
$table="merchant_slave";
    $tid="slave_id";
}
 $target = "logo/";
 $target = $target . basename( $_FILES['file']['name']) ; 
 $name = basename( $_FILES['file']['name']);

 if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) 
 {
    $query1="UPDATE `$table` SET `logo`='$name' where `$tid`='$id'";
     echo $query1;
$sql=mysqli_query($userdb,$query1); 
     
     
//header('Location:info.php');
	 

 } 
 else {
 echo "Sorry, there was a problem uploading your file.";
 }

header('location: info.php');


 ?> 

