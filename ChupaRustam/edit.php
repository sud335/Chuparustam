<?php
session_start();
include_once("common_code/userdb.inc.php");
 if(!empty($_SESSION['uname']))
    {
             $uname = $_SESSION['uname'];
             $query = "SELECT * from merchant_login where uname = '$uname'";
             $res=mysqli_query($userdb, $query);
                while($row = mysqli_fetch_array($res)){
                    $id = $row['merchant_id'];  
                    $role = $row['role'];
            }
     
 }
     
     
if(isset($_POST['company_name'])){
    $company_name = $_REQUEST['company_name'];
    if ($role==='MASTER'){
        $sql = "UPDATE merchant_master SET propriety_name='$company_name' where master_id=$id";
        mysqli_query($userdb,$sql);}}
if(isset($_POST['category'])){
    $category = $_REQUEST['category'];
    if ($role==='MASTER'){
        $sql = "UPDATE merchant_master SET categoire='$category' where master_id=$id";
        mysqli_query($userdb,$sql);}}
if(isset($_POST['address'])){
    $address = $_REQUEST['address'];
    if ($role==='MASTER'){
        $sql = "UPDATE merchant_master SET office_address='$address' where master_id=$id";
        mysqli_query($userdb,$sql);}
    else if($role==='SLAVE'){
         $sql = "UPDATE merchant_slave SET address='$address' where slave_id=$id";
        mysqli_query($userdb,$sql);}}
if(isset($_POST['name'])){
    $name = $_REQUEST['name'];
    if ($role==='MASTER'){
        $sql = "UPDATE merchant_master SET cp_name='$name' where master_id=$id";
        mysqli_query($userdb,$sql);}
    else if($role==='SLAVE'){
         $sql = "UPDATE merchant_slave SET name='$name' where slave_id=$id";
        mysqli_query($userdb,$sql);}}
if(isset($_POST['contact'])){
    $contact = $_REQUEST['contact'];
     if ($role==='MASTER'){
        $sql = "UPDATE merchant_master SET cp_phone='$contact' where master_id=$id";
        mysqli_query($userdb,$sql);}
    else if($role==='SLAVE'){
         $sql = "UPDATE merchant_slave SET contact='$contact' where slave_id=$id";
        mysqli_query($userdb,$sql);}}
if(isset($_POST['email'])){
    $email = $_REQUEST['email'];
     if ($role==='MASTER'){
        $sql = "UPDATE merchant_master SET email='$email' where master_id=$id";
        mysqli_query($userdb,$sql);}
    else if($role==='SLAVE'){
         $sql = "UPDATE merchant_slave SET email='$email' where slave_id=$id";
        mysqli_query($userdb,$sql);}}
            
if(isset($_POST['day'])){
        //echo 'day found';
    $j = 1;
    foreach($_POST['day'] as $value)
    {   
        $day[$j] = $value;
        $j++;
    }
    $columns2 = implode(",",array_keys($day));
    $escaped_values2 = array_map('mysql_real_escape_string', array_values($day));
    $values215  = implode(",", $escaped_values2);}
   
if(isset($_POST['datetimepicker1'])){
$datepicker1=$_POST['datetimepicker1'];}

if(isset($_POST['datetimepicker1'])){
$datepicker2=$_POST['datetimepicker2'];}

if(isset($_POST['categoryidentifier'])){
$categoryidentifier=$_POST['categoryidentifier'];}
if(isset($_POST['slaveid'])){
$slaveid=$_REQUEST['slaveid'];}

if($categoryidentifier==="APPAREL"){        //save in category_apparel

    //echo 'apparel';
    if(isset($_POST['men']))
    {
    //echo 'men found';
    $j = 1;
    foreach($_POST['men'] as $value1)
    {   
        $men[$j] = $value1;
        $j++;
    }
    $columns21 = implode(",",array_keys($men));
    $escaped_values21 = array_map('mysql_real_escape_string', array_values($men));
    $values21  = implode(",", $escaped_values21);
    //echo $values21;

    }else{
        $values21=NULL;
    }

    if(isset($_POST['women']))
    {
    //echo 'women found';
    $j = 1;
    foreach($_POST['women'] as $value2)
    {   
        $women[$j] = $value2;
        $j++;
    }
    $columns213 = implode(",",array_keys($women));
    $escaped_values213 = array_map('mysql_real_escape_string', array_values($women));
    $values213  = implode(",", $escaped_values213);
    //echo $values213;
    }else{
        $values213=NULL;
    }

    if(isset($_POST['kid']))
    {
    //echo 'kid found';
    $j = 1;
    foreach($_POST['kid'] as $value3)
    {   
        $kid[$j] = $value3;
        $j++;
    }
    $columns214 = implode(",",array_keys($kid));
    $escaped_values214 = array_map('mysql_real_escape_string', array_values($kid));
    $values214  = implode(",", $escaped_values214);
    //echo $values214;
    }else{
        $values214=NULL;
    }
    $query1 = "UPDATE category_apparel SET men='$values21' WHERE slave_id = '$slaveid' ";
$sqlslaveinsert=mysqli_query($userdb,$query1);
   
       $query1 = "UPDATE category_apparel SET women='$values213' WHERE slave_id = '$slaveid' ";
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_apparel SET kids='$values214' WHERE slave_id = '$slaveid' ";
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_apparel SET closed_days='$values215' WHERE slave_id = '$slaveid' ";
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_apparel SET open_time='$datepicker1' WHERE slave_id = '$slaveid' ";
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_apparel SET close_time='$datepicker2' WHERE slave_id = '$slaveid' ";
$sqlslaveinsert=mysqli_query($userdb,$query1);

}//apparel close

if($categoryidentifier==="FOOD"){  //save in category_food

//echo 'food';
    if(isset($_POST['availoption']))
    {
    //echo 'availoption found';
    $j = 1;
    foreach($_POST['availoption'] as $value1)
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

    if(isset($_POST['highlights']))
    {
    //echo 'highlights found';
    $j = 1;
    foreach($_POST['highlights'] as $value2)
    {   
        $highlights[$j] = $value2;
        $j++;
    }
    $columns213 = implode(",",array_keys($highlights));
    $escaped_values213 = array_map('mysql_real_escape_string', array_values($highlights));
    $values213  = implode(",", $escaped_values213);
    //echo $values213;
    }else{
        $values213=NULL;
    }
    if(isset($_POST['recommendoptions'])){
        $recommendations=$_POST['recommendoptions'];
        //echo $recommendations;
    }else{
        $recommendations=NULL;
    }
    
      $query1 = "UPDATE category_food SET sub_categorie='$values21' WHERE slave_id = '$slaveid' ";
      //echo $query1;
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_food SET recommended_dish='$recommendations' WHERE slave_id = '$slaveid' ";//echo $query1;
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_food SET highlights='$values213' WHERE slave_id = '$slaveid' ";//echo $query1;
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_food SET closed_days='$values215' WHERE slave_id = '$slaveid' ";//echo $query1;
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_food SET open_time='$datepicker1' WHERE slave_id = '$slaveid' ";//echo $query1;
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_food SET close_time='$datepicker2' WHERE slave_id = '$slaveid' ";//echo $query1;
$sqlslaveinsert=mysqli_query($userdb,$query1);
//echo 'suc';

}//food close

if($categoryidentifier==="GROOMING"){  //save in category_wellness

//echo 'grooming';
    if(isset($_POST['sub_category']))
    {
    //echo 'sub_category found';
    $j = 1;
    foreach($_POST['sub_category'] as $value1)
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

    if(isset($_POST['subsub_category']))
    {
    //echo 'subsub_category found';
    $j = 1;
    foreach($_POST['subsub_category'] as $value2)
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
$query1 = "UPDATE category_wellness SET sub_categorie='$values21' WHERE slave_id = '$slaveid' ";
      //echo $query1;
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_wellness SET sub_sub_categorie='$values213' WHERE slave_id = '$slaveid' ";//echo $query1;
$sqlslaveinsert=mysqli_query($userdb,$query1);

  $query1 = "UPDATE category_wellness SET closed_days='$values215' WHERE slave_id = '$slaveid' ";//echo $query1;
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_wellness SET open_time='$datepicker1' WHERE slave_id = '$slaveid' ";//echo $query1;
$sqlslaveinsert=mysqli_query($userdb,$query1);
  $query1 = "UPDATE category_wellness SET close_time='$datepicker2' WHERE slave_id = '$slaveid' ";//echo $query1;
$sqlslaveinsert=mysqli_query($userdb,$query1);
//echo 'suc';   


}
header('location: info.php');
?>


