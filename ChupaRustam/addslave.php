<html>
    <head>
       <title></title>

       <script type="text/javascript">
            function run(uname,pass)
			{
				var abc='MAKE NOTE: \n Username ='+uname+'\n Password :'+pass;
				
                alert(abc);
				window.location.assign("my-outlets.php")
				//location.href="my-outlets.php";
            }


       </script>

    </head>
    <body>
    </body>
</html>
<?php
include_once("common_code/userdb.inc.php");
session_start();
if(!(empty($_SESSION['uname'])))
{

	if (isset($_POST['submit']))
	{
    
    
    
		$email='hweasldlm';
		$role='MASTER';
		$merchantid=$_SESSION['uname'];
		$res = $mysqli->query("SELECT role FROM merchant_login WHERE uname = '$merchantid'");
		$row = $res->fetch_assoc();


    
		
    
		if($role===$row['role'])
		{
			$name = $_REQUEST['name'];
			$address = $_REQUEST['address']; 
			$contact=$_REQUEST['contact'];
			$email=$_REQUEST['emailid'];



			$seed = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789!@#$%^&*()'); 
			shuffle($seed);
			$rand = '';
			foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];    
			//echo $rand;//password
			
			$slaveusername=$name.$contact;
			$slavepass=$rand;
			$slaverole="SLAVE";

			$id = $_REQUEST['id'];
    
 
    
			$res1 = $mysqli->query("SELECT * FROM merchant_master WHERE master_id = '$id'");
			$row1 = $res1->fetch_assoc();
	
			$category= $row1['categorie'];
    
			//echo $slaveusername;    
			
			//insert into merchant_login table
			$sqlslave=mysqli_query($userdb,"INSERT into merchant_login(uname,upass,role) VALUES ('$slaveusername','$slavepass','$slaverole')");
			
			
			$res = $mysqli->query("SELECT merchant_id FROM merchant_login WHERE uname = '$slaveusername'");
			$row = $res->fetch_assoc();
			$mid=$row['merchant_id'];
			
			$slaveusername=$merchantid.$mid;
			//echo $slaveusername;//Slaveusername
			
			
            echo "<script>run('";echo $slaveusername."','".$slavepass;echo"')</script>";
          
			
			$sqlslave=mysqli_query($userdb,"UPDATE  `chuparustam`.`merchant_login` SET  `uname` =  '$slaveusername' WHERE  `merchant_login`.`merchant_id` ='$mid';");
			
			
			$query1="INSERT INTO `chuparustam`.`merchant_slave` ( `slave_id`,`master_id`, `name`, `address`, `contact`,`email`) VALUES ( '$mid','$id', '$name', '$address', '$contact','$email');";
			$sqlslaveinsert=mysqli_query($userdb,$query1);
				
		
			if($category==='GROOMING')
			{ 
				$que = "INSERT INTO `category_wellness` (`slave_id`, `sub_categorie`, `sub_sub_categorie`, `closed_days`, `open_time`, `close_time`) VALUES ('$mid', 'NULL', 'NULL', 'NULL', '00:00:00', '00:00:00')";    
				$sqlinsert=mysqli_query($userdb,$que);    
			}
    
			if($category==='APPAREL')
			{   
	
				$que= "INSERT INTO `category_apparel` (`slave_id`, `men`, `women`, `kids`, `closed_days`, `open_time`, `close_time`) VALUES ('$mid', 'NULL', 'NULL', 'NULL', 'NULL', '00:00:00', '00:00:00')";
				$sqlinsert=mysqli_query($userdb,$que);   
			}    
    
    
			if($category==='FOOD')
			{      
				$que= "INSERT INTO `chuparustam`.`category_food` (`slave_id`, `sub_categorie`, `recommended_dish`, `highlights`, `closed_days`, `open_time`, `close_time`) VALUES ('$mid', 'NULL', NULL, 'NULL', 'NULL', '00:00:00', '00:00:00')";   
				$sqlinsert=mysqli_query($userdb,$que);   
			}   
    
    
    
//echo '<h1>success</h1>';
//header('location:my-outlets.php');
		}
	

	}

}


?>