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
            
header('location: info.php');
?>


