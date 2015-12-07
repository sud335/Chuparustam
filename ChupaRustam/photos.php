<?php
session_start();
if(!empty($_SESSION['uname']))
    {
		include_once("common_code/userdb.inc.php");
		$user =  $_SESSION['uname'];
		$result = mysqli_query($mysqli,"SELECT * FROM merchant_login WHERE uname = '$user'");
		while($row = mysqli_fetch_array($result))
		{
            $mid = $row['merchant_id'];
            $role=$row['role'];
		}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>MY SHOP</title>
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link href="css/bootstrap-multiselect.css" type="text/css" rel="stylesheet">
     <link href="css/jquery.datetimepicker.css" type="text/css" rel="stylesheet">
    
	<script src="js/jquery.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>

<!-- #############################  NAV BAR STARTS ############################### -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="images/logo.png" class="img-responsive" style="margin-top: -12px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
			<!-- #############################  NAV RIGHT OPTIONS STARTS ############################### -->            
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">FAQS</a>
                    </li>
                    <li><a href="#">CONTACT</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Name <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Profile Settings</a>
                            </li>
                            <li><a href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            <!-- #############################  NAV RIGHT OPTIONS ENDS ############################### -->    
            </div>
        </div>
    </nav>
<!-- #############################  NAV BAR ENDS ############################### -->

<!-- #############################  MAIN CONTAINER STARTS ############################### -->
    <div class="container main-container">
    <!-- #############################  LEFT COL STARTS ############################### -->
        <div class="col-md-2 left-col">
            <div class="tabbable tabs-left">
            <!-- #############################  LEFT NAV STARTS ############################### -->    
                <ul class="nav nav-tabs">
                    <li><a href="redeem.php"><i class="glyphicon glyphicon-send"></i>&nbsp;&nbsp; REDEEM</a>
                    </li>
                    <li><a href="info.php"><i class="glyphicon glyphicon glyphicon-hdd"></i>&nbsp;&nbsp; INFO</a>
                    </li>
                    <li><a href="my-outlets.php"><i class="glyphicon glyphicon-th"></i>&nbsp;&nbsp; MY OUTLETS</a>
                    </li>
                    <li><a href="offers.php"><i class="glyphicon glyphicon glyphicon-bullhorn"></i>&nbsp;&nbsp; OFFERS</a>
                    </li>
                    <li class="active"><a href="photos.php"><i class="glyphicon glyphicon-picture"></i>&nbsp;&nbsp; PHOTOS</a>
                    </li>
                    <li><a href="#c"><i class="glyphicon glyphicon-tasks"></i>&nbsp;&nbsp; INSIGHTS</a>
                    </li>
                    <li><a href="#c"><i class="glyphicon glyphicon-wrench"></i>&nbsp;&nbsp; SETTINGS</a>
                    </li>
                </ul>
          <!-- #############################  LEFT NAV ENDS ############################### -->    
   

            </div>
        </div>
   <!-- #############################  LEFT COL ENDS ############################### -->
   <!-- #############################  MIDDLE COL STARTS ############################### -->
        <div class="col-md-7 middle-col" style="width:62%">
			 <div class="col-md-10 col-xs-offset-1">
                <!--<div class="form-group">
					<label class="control-label">Select File</label>
						<div class="input-group ">
							<div tabindex="-1" class="form-control file-caption  kv-fileinput-caption">
								<div class="file-caption-name" style="width: 24px;" title=""></div>
							</div>
						
							<div class="input-group-btn">
								<label for="input-2">
									<div id="bid" class="btn btn-primary btn-file"> <i class="glyphicon glyphicon-folder-open"></i> &nbsp;Browse …<div style="height:0px;"> <input id="input-2" type="file" class="file"  multiple="true" ></div></div>
									
								</label>
								<div id="upid" class="btn btn-primary btn-file "><button class="btn btn-primary" type="submit"> <i class="glyphicon glyphicon-upload"></i> &nbsp;Upload…</button></div>
							</div>					
						
						</div>
                </div>-->
				 <div class="row">
				    <form method="post" enctype="multipart/form-data"action="photosupload.php">
						<label for="fileb">

							<br>
							<br>
							<input id="uploadFileb" placeholder="File Name " size="40" class="text-area no-display"  />
							<button class="btn btn-primary no-display" type="submit" id="upbtn" onChange="$('#uploadFileb').addClass('no-display');">UPLOAD IMAGE</button>

							<!--<img src="images/add.png" alt="Add new Image" class="img-thumbnail add-logo " width="50%">-->
							<div id="bid" class="btn btn-primary btn-file" title="Ctrl+select multiple pics"><i class="glyphicon glyphicon-folder-open" ></i> &nbsp;Browse …</div>
								
							<div style="height:0px;overflow:hidden">
								<input type='file' name="files[]" id="fileb" multiple="multiple" onchange="document.getElementById('uploadFileb').value = this.value; $('#uploadFileb').removeClass('no-display'); $('#upbtn').removeClass('no-display');" required>
							</div>
							
							<input type="hidden" name="id" value="<?php echo $mid; ?>">
							<input type="hidden" name="role" value="<?php echo $role; ?>">
	
						</label>
						
						<br>
						<br>
                    </form>		
				</div>
				
				<div class="row">
                <?php 
				if($role==="SLAVE")
				{
                    $result = mysqli_query($mysqli,"SELECT * FROM photo_at_outlets WHERE slave_id = '$mid'");
					while($row = mysqli_fetch_array($result))
					{      
                          $picid=$row['picture_id'];
						  $sql=mysqli_query($mysqli,"SELECT * FROM merchant_photos WHERE picture_id = '$picid'");
						
						  while($row1=mysqli_fetch_array($sql))
						  {	 
						  ?>
						
						<div class="col-md-3 col-sm-4 col-xs-6 thumb-img">
							<img src="photos/<?php echo $row1['picture_name']; ?>" alt="img2" class="img-responsive img-thumb" width="100%">
						</div>
				<?php		}
					}
				}
				else if($role==="MASTER")
				{
						  $sql=mysqli_query($mysqli,"SELECT * FROM merchant_photos WHERE merchant_id = '$mid'");
						
						  while($row1=mysqli_fetch_array($sql))
						  {	 
						  ?>
						
						<div class="col-md-3 col-sm-4 col-xs-6 thumb-img">
							<img src="photos/<?php echo $row1['picture_name']; ?>" alt="img2" class="img-responsive img-thumb" width="100%">
						</div>
				<?php		}
				}	
					?>					
				</div>
		</div>
	</div>
	
<script src="js/bootstrap.min.js"></script> <!-- Bootstrap script -->
</body>
</html>
<?php }
else
	header('Location:index.php');
	?>