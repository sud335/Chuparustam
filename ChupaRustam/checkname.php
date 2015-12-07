<?php
include_once("common_code/userdb.inc.php");

if(isset($_POST['name'])){
$name=$_POST['name'];
echo $name;
$res = $mysqli->query("SELECT uname FROM merchant_login WHERE uname = '$name'");
$row = $res->fetch_assoc();

echo $row['uname'];
 
if($row){
echo 'Valid';

}
else{
echo 'Username exists';

}
}
?>