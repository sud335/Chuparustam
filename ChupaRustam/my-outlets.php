<!DOCTYPE html>
<html>
<?php
      session_start();
?>
<?php
  
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
           /* echo $id,$role;*/
     
      }
                          
      if(!empty($_SESSION['uname']))
      {
?>
<head>
    <meta charset="UTF-8">
    <title>MY SHOP</title>
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet">
     <link href="css/jquery.datetimepicker.css" type="text/css" rel="stylesheet">
     <link href="css/bootstrap-tagsinput.css" type="text/css" rel="stylesheet">
    
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    
</head>

<body>
<!-- #############################  LOADING IMG ############################### -->
<div class="loadinggif">
	<img src="images/img-loading.gif" style="margin-top:100px;" >
</div>
<!-- #############################  LOADING IMG ENDS ############################### -->
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
                    <li ><a href="redeem.php"><i class="glyphicon glyphicon-send"></i>&nbsp;&nbsp; REDEEM</a>
                    </li>
                    <li><a href="info.php"><i class="glyphicon glyphicon glyphicon-hdd"></i>&nbsp;&nbsp; INFO</a>
                    </li>
                    <li class="active"><a href="my-outlets.php"><i class="glyphicon glyphicon-th"></i>&nbsp;&nbsp; MY OUTLETS</a>
                    </li>
                    <li><a href="offers.php"><i class="glyphicon glyphicon glyphicon-bullhorn"></i>&nbsp;&nbsp; OFFERS</a>
                    </li>
                    <li><a href="photos.php"><i class="glyphicon glyphicon-picture"></i>&nbsp;&nbsp; PHOTOS</a>
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
        <div class="col-md-7 middle-col" style="width:62%;height:auto;">
		<?php 
			if($role==="MASTER")
			{ ?>
        	<div class="col-md-10 col-xs-offset-1">
                 <div class="col-lg-12" style="background:#FFF;margin-top:15px;padding:20px;padding-bottom:0px;">
                 	<div class="box-outlet">
                        <form class="form-horizontal" role="form" action="addslave.php" method="POST">
                          <div class="form-group">
                            <label for="" class="col-sm-3 control-label">NAME : </label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="n" placeholder="Enter Name" required name="name">
                            </div>
                          </div>
                          
                           <div class="form-group">
                            <label for="" class="col-sm-3 control-label">ADDRESS : </label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="" placeholder="Enter Address" required name="address">
                            </div>
                          </div>
                          
                           <div class="form-group">
                            <label for="" class="col-sm-3 control-label">CONTACT : </label>
                            <div class="col-sm-9"> 
                              <input type="text" class="form-control" id="c" pattern="(\+?\d[- .]*){10,11}" title="Mobile number or local phone number (eg.012-34567891)" placeholder="Enter Contact Number" name="contact" required >
                            </div>
                          </div>
                          
                           <div class="form-group">
                            <label for="" class="col-sm-3 control-label">EMAIL : </label>
                            <div class="col-sm-9">
                              <input type="email" class="form-control" id="" placeholder="Enter Email Id" required name="emailid">
                              <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                             <div class="col-sm-12">
                             <input type="submit" name='submit' class="btn btn-primary confirm" " <?php if($role==="SLAVE")echo'disabled><span style="color:red">You dont have rights</span>';?><div class="glyphicon glyphicon-th-list" value="ADD OUTLET"></div>
                           </div>
                            </div>
                        </form>
                    </div>    
                 </div>
			<?php }
				  else if($role==="SLAVE")
				  {
				  
						echo "This account does not have the permission to add more outlets. Please contact your senior management or Log in with the Admin account. ";
				  }
				?>
                 <div class="col-lg-12" style="margin-top:15px;padding:20px;">
                     <table width="100%">
                        
						<?php
                            include_once("common_code/userdb.inc.php");
                            $res = $mysqli->query("SELECT * FROM merchant_slave WHERE master_id = '$id'");
                           
                           while( $row = $res->fetch_assoc())
                           {
							  echo '<tr>
									<td>  
									<div class="col-lg-12 search-result" style="padding:20px;height:auto">
										<div class="box-outlet1">
											<form class="form-horizontal" role="form">';
												echo '	<div class="form-group ">
															<label for="" class="col-sm-3 control-label">NAME : </label>
															<div class="col-sm-9">
																<p class="simple-text">';
																echo $row['name'];
																echo '&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp&nbsp &nbsp &nbsp &nbsp 
																		<!--<div class="col-md-4 thumb-img ">
																			<img src="notverified.png" alt="img2" class="img-responsive img-thumb" width="100%">
																		</div>-->
																</p>																
															</div>
														</div>';
                          
												echo '<div class="form-group">
														<label for="" class="col-sm-3 control-label">ADDRESS : </label>
														<div class="col-sm-9">
															<p class="simple-text">';
																echo $row['address'];
														echo '</p>
														</div>
													</div>';
												echo '<div class="form-group">
														<label for="" class="col-sm-3 control-label">CONTACT : </label>
														<div class="col-sm-9">
															<p class="simple-text">';
																echo $row['contact'];
															echo '</p>
														</div>
													</div>';
												echo '<div class="form-group">
														<label for="" class="col-sm-3 control-label">EMAIL : </label>
														<div class="col-sm-9">
															<p class="simple-text">';
																echo $row['email'];
													   echo '</p>
													   </div>
													</div>';
												echo ' <div class="form-group" style="margin-bottom: -2px;">
															<div class="col-sm-12">
																<button type="button" class="btn btn-primary confirm" data-toggle="modal" data-target="#complete-info1';echo $row['slave_id'];echo'"><div class="glyphicon glyphicon-thumbs-up" ></div>  EDIT AND ADD COMPLETE INFO</button>
															</div>
															<br>
														</div>
											</form>
										</div>
									</div>';
                        
								//pop up !!!!!!!! here new div starts!!!! div=2 m+inner tab=1 
									echo ' <div class="modal fade-in" id="complete-info1';echo $row['slave_id'];echo'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg">
															<div class="modal-content" >
																	<!-----------Header starts-------->
																	<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																			<h4 class="modal-title text-center" id="myModalLabel">COMPLETE INFO 1</h4>
																	</div>
																	<!-----------Body starts-------->
																	<div class="modal-body pop-up-body">';
                            
																			$slavename=$row['name'];
																			$myid=$row['slave_id'];
																			echo '<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="form" action="updateslave.php"';echo'">
																					<div class="form-group">
																							<label for="" class="col-sm-3 control-label">NAME : </label>
																							<div class="col-sm-6">
																									<input type="text" class="form-control" name="slavename" id="" placeholder="Enter Name" value="'; echo $slavename;echo'" required>
																							</div>
																							
																							<div class="col-sm-6">
																								<input type="hidden" class="form-control" name="slaveid" id="" value="';echo $row['slave_id'];echo'">
																							</div>
																					</div>
                                  
																					<div class="form-group">
																							<label for="" class="col-sm-3 control-label">ADDRESS : </label>
																							<div class="col-sm-6">
																									<input type="text" class="form-control" name="address" id="" placeholder="Enter Address" value="'; echo $row['address'];echo'" required>
																							</div>
																					</div>
                                  
																					<div class="form-group">
																							<label for="" class="col-sm-3 control-label">CONTACT : </label>
																							<div class="col-sm-6">
																									<input type="text" class="form-control" id="" name="contact" placeholder="Enter Contact Number" value="'; echo $row['contact'];echo'" required>
																							</div>
																					</div>
                                  
																					<div class="form-group">
																							<label for="" class="col-sm-3 control-label">Email Id : </label>
																							<div class="col-sm-6">
																									<input type="text" class="form-control" id="" name="email" placeholder="Enter Email Id" value="'; echo $row['email'];echo'" >
																							</div>
																					</div>
													
																					<div class="form-group">
																							<label for="" class="col-sm-3 control-label">Upload LOGO : </label>
																							<div class="col-md-2 profile-img">
																								<br>';
									?>
																								<img src="logo/<?php echo $row['logo']; ?>" id="preview" alt="Add new Image" class="img-responsive img-thumb" width="100%" style="height:100px">
																								<input type="file" name="file" placeholder="Select Logo"  onchange="readURL(this);"></input>
                      
                         <?php       
								echo '														</div>
																					</div><!--logo pic div-->';
																					
																			$res1 = $mysqli->query("SELECT * FROM merchant_master WHERE master_id = '$id'"); 
																			echo '<input type="hidden" value="';echo $row['slave_id']; echo '" name="slaveid">';

										
																			while( $row1 = $res1->fetch_assoc())
																			{
																					$categorie= $row1['categorie'];
																					$close_time='';
																					$closed_days='';
																					$open_time='';	
																					
																			    if($categorie==="FOOD")
																				{
                          ?>       
																					<div class="form-group">
																						<label for="" class="col-sm-3 control-label">RESTRO: </label>
																						
																						<div class="col-md-4 thumb-img">																																
																							<input id="imgfile1" name="img1[]" type="file"  multiple="multiple"/> 
																						</div>
																						
																						<div class="col-md-4 thumb-img">																							
																							<br>
																							<br>
																						</div>
										
																						<div class="form-group">
																							<label for="" class="col-sm-3 control-label">BAR :</label>
										
																							<div class="col-md-4 thumb-img">
																									<input id="imgfile3" name="img3[]" type="file" multiple="multiple"/> 										
																							</div>
									
																							<div class="col-md-4 thumb-img">												
																							</div>
																						</div>
																					</div><!--End of Photos div:-->
																					
																				<?php }
																					elseif($categorie==="GROOMING")
																					  {
																					     ?>
																						 <div class="form-group">
																							<label for="" class="col-sm-3 control-label">RATE LIST IMAGES: </label>
																						
																							<div class="col-md-4 thumb-img">																																
																								<input id="imgfile1" name="img2[]" type="file"  multiple="multiple"/> 
																							</div>
																						
																							<div class="col-md-4 thumb-img">																							
																								<br>
																								<br>
																							</div>
																						</div>
																						
																				<?php	  }
																				?>	  
																				<!--<div class="form-group">
																						<label for="" class="col-sm-3 control-label">UPLOADED PHOTOS ARE:</label>
																				
																				<?php 
																						/*	$myid=$row['slave_id'];
																							$result = mysqli_query($mysqli,"SELECT * FROM merchant_photos WHERE merchant_id = '$myid'");
																							$count=0;
																							$f=0;
																							while($row = mysqli_fetch_array($result))
																							{      
																									if($count%2===0&&$count!==0)
																									{	$f=0;
																										echo '
																										<div class="form-group">
																											<label for="" class="col-sm-3 control-label"></label>';
																									}
																									else 
																									{$f=1;}												
																				?>
                
																											<div class="col-md-4 thumb-img ">
																												<img src="images/upload/<?php echo $row['picture_name']; ?>" alt="img2" class="img-responsive img-thumb" width="30%">
																											</div>
                
																				<?php
																									if($f===1&&$count!==0&&$count!==1)
																									{
																											echo'</div>';
																									}
																									$count= $count+1;
																							}	*/											
																				?>
																				</div>-->
			 <?php	
                                    echo'                                 
                                  
																					<div class="form-group ">
																							<label for="" class="col-sm-3 control-label">Available Options : </label>';
								

																											if($categorie==='FOOD')
																											{
																												$qyee="Select * from category_food where slave_id='$myid'";
																												$res349=mysqli_query($mysqli,$qyee);
																												while($row349=mysqli_fetch_array($res349))
																												{
																															$sub_cat=$row349['sub_categorie'];
													
																															$high=$row349['recommended_dish'];
																															$recdish=$row349['highlights'];
																															$closed_days=$row349['closed_days'];
																															$open_time=$row349['open_time'];
																															$close_time=$row349['close_time'];
	
																												}
																												//available options
																													echo '<input type="hidden" value="FOOD" name="categoryidentifier">';
												
											
																													echo '<label class="checkbox-inline">';
																													echo'<input type="checkbox" name="availoption[]" class="availoption" id="inlineCheckbox1" value="QUICKBITE" ';if (strpos($sub_cat,"QUICKBITE") !== false) {echo 'checked';}echo ' >QUICKBITE
																													</label>';
												 
													
																													echo '<label class="checkbox-inline">';
																													echo'<input type="checkbox" name="availoption[]" class="availoption" id="inlineCheckbox1" value="RESTRO" ';if(isset($sub_cat)) if (strpos($sub_cat,"RESTRO") !== false) {echo 'checked';}echo '>RESTRO
																													</label>';
														
																													echo '<label class="checkbox-inline">';
																													echo'<input type="checkbox" name="availoption[]" class="availoption" id="inlineCheckbox1" value="BAR" ';if(isset($sub_cat)) if (strpos($sub_cat,"BAR") !== false) {echo 'checked';}echo '>BAR
																													</label></br>';
																																									
																													echo '<label class="checkbox-inline">';
																													echo'<input type="checkbox" name="highlights[]" class="availoption" id="inlineCheckbox1" value="WIFI" ';if(isset($recdish)) if (strpos($recdish,"WIFI") !== false) {echo 'checked';}echo '>WIFI
																													</label>';
																													echo '<label class="checkbox-inline">';
																													echo'<input type="checkbox" name="highlights[]" class="availoption" id="inlineCheckbox1" value="DINE-IN"';if(isset($recdish)) if (strpos($recdish,"DINE-IN") !== false) {echo 'checked';}echo ' >DINE IN
																													</label>';
																													echo '<label class="checkbox-inline">';
																													echo'<input type="checkbox" name="highlights[]" class="availoption" id="inlineCheckbox1" value="NON-VEG" ';if(isset($recdish)) if (strpos($recdish,"NON-VEG") !== false) {echo 'checked';}echo '>NON VEG
																													</label>';

																													echo '<label class="checkbox-inline">';
																													echo'<input type="checkbox" name="highlights[]" class="availoption" id="inlineCheckbox1" value="TAKE-OUT" ';if(isset($recdish)) if (strpos($recdish,"TAKE-OUT") !== false) {echo 'checked';}echo '>TAKE OUT
																													</label>
																					</div>';//close div for food available cat inside if.
																												//recommended options
																												echo' 
																													<div class="form-group">
																														<label for="" class="col-sm-3 control-label">Recommended Options : </label>											
																														<label class="checkbox-inline text-left">
																															<input type="text" name="recommendoptions" class="form-control" value="';if(isset($recdish)) echo $recdish; echo'" size ="20" data-role="tagsinput" />
																														</label>                                    
																													</div>';
												
																											}				
																											else if($categorie==='GROOMING')
																											{

																														$qyee="Select * from category_wellness where slave_id='$myid'";
																														$res349=mysqli_query($mysqli,$qyee);
																														while($row349=mysqli_fetch_array($res349))
																														{
																																$sub_cat=$row349['sub_categorie'];
																																$subsubcat=$row349['sub_sub_categorie'];
																																$closed_days=$row349['closed_days'];
																																$open_time=$row349['open_time'];
																																$close_time=$row349['close_time'];
	
																														}
													
																														echo '<input type="hidden" value="GROOMING" name="categoryidentifier">';

	
																														echo '<label class="checkbox-inline">';
																																echo'<input type="checkbox" name="sub_category[]" class="availoption" id="inlineCheckbox1" value="SPA" ';if(isset($sub_cat)) if (strpos($sub_cat,"SPA") !== false) {echo 'checked';}echo '>Spa
																														</label>';
																														echo '<label class="checkbox-inline">';
																																echo'<input type="checkbox" name="sub_category[]" class="availoption" id="inlineCheckbox1" value="SALOON" ';if(isset($sub_cat)) if (strpos($sub_cat,"SALOON") !== false) {echo 'checked';}echo '>Saloon
																														</label>
																														<br>';
	

														
																															echo '<label class="checkbox-inline">';
																																echo'<input type="checkbox" name="subsub_category[]" class="availoption" id="inlineCheckbox1" value="UNISEX" ';if(isset($sub_cat)) if (strpos($subsubcat,"UNISEX") !== false) {echo 'checked';}echo '>Unisex
																																</label>';
																															echo '<label class="checkbox-inline">';
																																echo'<input type="checkbox" name="subsub_category[]" class="availoption" id="inlineCheckbox1" value="MEN" ';if(isset($subsubcat)) if (strpos($subsubcat,"MEN") !== false) {echo 'checked';}echo '>Men
																															</label>';
																															echo '<label class="checkbox-inline">';
																																echo'<input type="checkbox" name="subsub_category[]" class="availoption" id="inlineCheckbox1" value="WOMEN" ';if(isset($subsubcat)) if (strpos($subsubcat,"WOMEN") !== false) {echo 'checked';}echo '>Women
																															</label>
																													
																														
																									</div>';//close div for WELLNESS available categ inside if.
																												
																											}																	
																											else if($categorie==='APPAREL')
																											{
																													$qyee="Select * from category_apparel where slave_id='$myid'";
																													$res349=mysqli_query($mysqli,$qyee);
																													while($row349=mysqli_fetch_array($res349))
																													{
																															$smen=$row349['men'];
																															$swomen=$row349['women'];
																															$skids=$row349['kids'];
																															$closed_days=$row349['closed_days'];
																															$open_time=$row349['open_time'];
																															$close_time=$row349['close_time'];
																													}
																													echo '<input type="hidden" value="APPAREL" name="categoryidentifier">';
																													echo '<b>MEN &nbsp;&nbsp;</b>';
																													echo '<label class="checkbox-inline">';
																														echo'<input type="checkbox" name="men[]" class="availoption" id="inlineCheckbox1" value="SHIRT" ';if(isset($smen)) if (strpos($smen,"SHIRT") !== false) {echo 'checked';}echo '>Shirt
																													</label>';
																													echo '<label class="checkbox-inline">';
																														echo'<input type="checkbox" name="men[]" class="availoption" id="inlineCheckbox1" value="JEANS" ';if(isset($smen)) if (strpos($smen,"JEANS") !== false) {echo 'checked';}echo '>Jeans
																													</label>';
																													echo '<label class="checkbox-inline">';
																														echo'<input type="checkbox" name="men[]" class="availoption" id="inlineCheckbox1" value="T-SHIRT" ';if(isset($smen)) if (strpos($smen,"T-SHIRT") !== false) {echo 'checked';}echo '>Tshirt
																													</label><br/>';

																																																									
																													echo '<b> WOMEN&nbsp;&nbsp;</b>';
																													echo '<label class="checkbox-inline">';
																														echo'<input type="checkbox" name="women[]" class="availoption" id="inlineCheckbox1" value="SHIRT" ';if(isset($swomen)) if (strpos($swomen,"SHIRT") !== false) {echo 'checked';}echo '>Shirt
																														</label>';
																													echo '<label class="checkbox-inline">';
																														echo'<input type="checkbox" name="women[]" class="availoption" id="inlineCheckbox1" value="JEANS" ';if(isset($swomen)) if (strpos($swomen,"JEANS") !== false) {echo 'checked';}echo '>Jeans
																													</label>';
																													echo '<label class="checkbox-inline">';
																														echo'<input type="checkbox" name="women[]" class="availoption" id="inlineCheckbox1" value="T-SHIRT" ';if(isset($swomen)) if (strpos($swomen,"T-SHIRT") !== false) {echo 'checked';}echo '>Tshirt
																													</label><br/>';
																												echo'<label for="" class="col-sm-3 control-label"></label>';														
																													
																													echo '<b>KID&nbsp;&nbsp;</b>';
																													echo '<label class="checkbox-inline">';
																														echo'<input type="checkbox" name="kid[]" class="availoption" id="inlineCheckbox1" value="SHIRT" ';if(isset($skids)) if (strpos($skids,"SHIRT") !== false) {echo 'checked';}echo '>Shirt
																													</label>';
																													echo '<label class="checkbox-inline">';
																														echo'<input type="checkbox" name="kid[]" class="availoption" id="inlineCheckbox1" value="JEANS" ';if(isset($skids)) if (strpos($skids,"JEANS") !== false) {echo 'checked';}echo '>Jeans
																													</label>';
																													echo '<label class="checkbox-inline">';
																														echo'<input type="checkbox" name="kid[]" class="availoption" id="inlineCheckbox1" value="T-SHIRT" ';if(isset($skids)) if (strpos($skids,"T-SHIRT") !== false) {echo 'checked';}echo '>Tshirt
																													</label><br/>';
																				
																				echo'</div>';//close div for apparell available categ inside if.																									
																											}
																									}//end of if categ
																																													
																				echo'    <div class="form-group col-md-12">
																				
																								<label for="" class="col-sm-3 control-label">OPEN DAYS : </label>
																								<input type="hidden" value="day" name="day">
																								<label class="checkbox-inline">
																									<input type="checkbox" name="day[]" class="day" id="inlineCheckbox1" value="MON" ';if(isset($closed_days)) if (strpos($closed_days,"MON") !== false) {echo 'checked';}echo '> MON
																								</label>
												
																								<label class="checkbox-inline">
																									<input type="checkbox" name="day[]" class="day" id="inlineCheckbox2" value="TUE" ';if(isset($closed_days)) if (strpos($closed_days,"TUE") !== false) {echo 'checked';}echo '> TUE
																								</label>
												
																								<label class="checkbox-inline">
																									<input type="checkbox" name="day[]" class="day" id="inlineCheckbox3" value="WED" ';if(isset($closed_days)) if (strpos($closed_days,"WED") !== false) {echo 'checked';}echo '> WED
																								</label>
												
																								<label class="checkbox-inline">
																									<input type="checkbox"  name="day[]" class="day" id="inlineCheckbox1" value="THU" ';if(isset($closed_days)) if (strpos($closed_days,"THU") !== false) {echo 'checked';}echo '> THU
																								</label>
											
																								<label class="checkbox-inline">
																									<input type="checkbox" name="day[]" class="day" id="inlineCheckbox1" value="FRI" ';if(isset($closed_days)) if (strpos($closed_days,"FRI") !== false) {echo 'checked';}echo '> FRI
																								</label>
												
																								<label class="checkbox-inline">
																									<input type="checkbox" name="day[]" class="day" id="inlineCheckbox2" value="SAT" ';if(isset($closed_days)) if (strpos($closed_days,"SAT") !== false) {echo 'checked';}echo '> SAT
																								</label>
											
																								<label class="checkbox-inline">
																									<input type="checkbox" name="day[]" class="day" id="inlineCheckbox3" value="SUN" ';if(isset($closed_days)) if (strpos($closed_days,"SUN") !== false) {echo 'checked';}echo '> SUN
																								</label>
                                    
																						</div>';
																				echo '                                   
																								<div class="form-group col-md-12">
																									<label for="" class="col-sm-3 control-label">TIMINGS : </label>
												
																									<div class="row">
												
																											<div class="col-sm-1 text-center">
																												From
																											</div>
												
																											<div class="col-xs-3">
																												<div class="input-group">
																													<input type="time" name="datetimepicker1" class="datetimepicker1 form-control time" type="text" required value="'; if(isset($open_time)) echo $open_time;echo'"">
																													<div class="input-group-addon"><i class="glyphicon glyphicon-time"></i>
																													</div>
																												</div>
																											</div>
											
																											<div class="col-sm-1 text-center">
																												To
																											</div>
												
																											<div class="col-xs-3">
																												<div class="input-group">
																													<input type="time" name="datetimepicker2" class="datetimepicker1 form-control time" type="text" required value="';if(isset($close_time)) echo $close_time;echo'"">
																													<div class="input-group-addon"><i class="glyphicon glyphicon-time"></i>
																													</div>
																												</div>
																											</div>
																									</div>
																								</div>';
?>
																	
																			
              
                   <?php
															echo '</div><!----------pop up bodycontent div-------------->
																	<!----------Footer Starts-------------->
																		<div class="modal-footer">
																				<button type="submit" class="btn btn-default" name="submit">Save</button>
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																		</div>
																	
																	</form>
															</div><!--pop up content Div-->
														</div><!--pop up content daig style Div-->
												</div><!--pop up complete content Div-->
							</td>  
                        </tr>';
                            }

                            
                    ?>
                                      
                                       
                                      
                                       
                                      
                                      
                                      
                                      
                                     
                             
                   
    <!-- END COMPLETE INFORMATION POP UP -->
                                
                            
                        
                      </table> 

           </div><!--inner div-->           
       <!--div count =1 main-->
         <!-- COMPLETE INFORMATION POP UP -->
                    <div class="modal fade" id="complete-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">TERMS AND CONDITIONS</h4>
                          </div>
                          <div class="modal-body">
                            <p>
                             Duis fermentum, velit non varius ullamcorper, lectus dui euismod nisl, eu faucibus metus ligula id risus. In hac habitasse platea dictumst. Aliquam sed sem eleifend, tempus ex rutrum, venenatis quam. Maecenas ac mauris in nulla elementum efficitur non sed nunc. Donec malesuada ex ipsum, in scelerisque sem accumsan vitae. Integer non tortor sit amet arcu eleifend dignissim sed at nulla. Fusce augue libero, aliquet in egestas a, tempus ut justo. Maecenas vitae nisl non erat dapibus dignissim. Suspendisse potenti. Mauris nec erat bibendum, facilisis arcu non, molestie sapien.</p>

								<p>Aliquam ut purus ex. Suspendisse non lorem id leo efficitur semper. Donec vulputate ullamcorper tristique. Morbi et ligula vitae metus aliquam condimentum. Morbi tellus velit, aliquam vitae augue ac, ullamcorper egestas odio. Donec quis condimentum neque, at suscipit metus. Aenean scelerisque dolor in dui tincidunt, quis eleifend eros dignissim. Aenean eleifend velit at convallis tempor. Sed efficitur molestie auctor. Mauris convallis tortor eget nisl iaculis pharetra. Cras ornare nulla fermentum felis egestas, consequat luctus sapien ullamcorper. Aenean vitae leo suscipit, feugiat velit quis, sollicitudin lacus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                            </p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
    <!-- END COMPLETE INFORMATION POP UP -->
     <!-- #############################  MIDDLE COL ENDS ############################### -->
     <!-- #############################  RIGHT COL STARTS ############################### -->    
        
    <!-- #############################  RIGHT COL ENDS ############################### -->    
    
    </div>

<!-- #############################  MAIN CONTAINER ENDS ############################### -->    
	
<!-- #############################  JAVASCRIPTS STARTS ############################### --> 
<script>
   function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview').src=e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>




    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap script -->
<!--     <script>
	 function validation() {
		validForm = true;
		var n = $( ".day:checkbox:checked" ).length;
		var m = $( ".availoption:checkbox:checked" ).length;

		if(m == 0)
		{
			alert('Select Atleast One Available Options ');
			return false;
		}
		if(n == 0)
		{
			alert('Select Atleast One Open Day ');
			return false;
		}
		
	 }
	</script> -->
   <script src="js/jquery.datetimepicker.js"></script>
    <script>
	$('.datetimepicker1').datetimepicker({
		datepicker:false,
		format:'H:i',
		step:5
	});
	</script>
      <script src="js/bootstrap-tagsinput.js"></script>
    
<!-- #############################  JAVASCRIPTS ENDS ############################### -->      
</body>

</html>
<?php } 
else
    header('Location:index.php');
?>