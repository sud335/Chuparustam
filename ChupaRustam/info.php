<?php
session_start();
if(!empty($_SESSION['uname']))
    {
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>MY SHOP</title>
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet">
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
<?php
include_once("common_code/userdb.inc.php");
$user =  $_SESSION['uname'];
$result = mysqli_query($mysqli,"SELECT * FROM merchant_login WHERE uname = '$user'");
		while($row = mysqli_fetch_array($result)){
            $mid = $row['merchant_id'];
              $role=$row['role'];}
    ?>
    
    <input type="hidden" name="mid" value="<?php echo $mid ?>">
<?php
if($role==='MASTER'){
    $table = "merchant_master";
   $where = "master_id";
}
if($role==='SLAVE'){
    $table = "merchant_slave";
 $where = "slave_id";
}


?>
    <!-- #############################  MAIN CONTAINER STARTS ############################### -->
    <div class="container main-container">
        <!-- #############################  LEFT COL STARTS ############################### -->
        <div class="col-md-2 left-col">
            <div class="tabbable tabs-left">
                <!-- #############################  LEFT NAV STARTS ############################### -->
                <ul class="nav nav-tabs">
                    <li><a href="redeem.php"><i class="glyphicon glyphicon-send"></i>&nbsp;&nbsp; REDEEM</a>
                    </li>
                    <li class="active"><a href="info.php"><i class="glyphicon glyphicon glyphicon-hdd"></i>&nbsp;&nbsp; INFO</a>
                    </li>
                    <li><a href="my-outlets.php"><i class="glyphicon glyphicon-th"></i>&nbsp;&nbsp; MY OUTLETS</a>
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
        <div class="col-md-7 middle-col" style="width:62%">
            <div class="col-md-10 col-xs-offset-1">
                    <div class="col-lg-12 info" style="background:#FFF;margin-top:35px;padding-bottom:25px;">
                    	<div class="info-box">
                            <form role="form" id="myform" style="padding:20px;" action="<?php if($role==='SLAVE') echo "edit.php"; if($role==='MASTER') echo "editm.php"; ?>" method="post">
                                <div class="form-group">
                                    <label for="">COMPANY / PROPERTY NAME : </label>
									<?php 
                                        $res = mysqli_query($mysqli, $q = "SELECT * FROM $table WHERE $where = '$mid'");
										while($row1 = mysqli_fetch_array($res))
										{
											
											$mymaster=$row1['master_id'];
											$q="Select * from merchant_master where master_id='$mymaster'";
											$res34=mysqli_query($mysqli,$q);
											while($row34=mysqli_fetch_array($res34))
											{
											$mcateg=$row34['categorie'];
											}
											
                                       
                                    ?>									
                                    <button type="button" id="company-cancel" class="btn btn-sm pull-right cancel-btn no-display" onClick="display('company-label','company-name','company-cancel','company-edit')" >Cancel</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="company-edit" class="btn btn-sm pull-right edit-btn" <?php if($role==='SLAVE') echo "disabled" ?> title="<?php echo $row1['propriety_name'];?>" onClick="display('company-name','company-label', 'company-edit','company-cancel',this.title);" >Edit</button>
                                    <div id="company-label">
										<?php echo $row1['propriety_name'];?>
									</div>
                                    <input type="text" name="company_name" contenteditable="true" id="company-name" class="form-control text-area no-display"  value="<?php echo $row1['propriety_name'];  ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="">CATEGORY :</label>
                                    <button type="button" id="category-cancel" class="btn btn-sm pull-right cancel-btn no-display" onClick="checkUndisplay('category')">Cancel</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="category-edit" disabled class="btn btn-sm pull-right edit-btn" onClick="checkDisplay('category')">Edit</button>
                                    <br>
									<input type="radio" <?php if($mcateg==="FOOD"){ echo 'checked';} else {echo 'disabled';} ?> class="category" name="category" value="Food"> Food &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" <?php if($mcateg==="APPAREL"){ echo 'checked';} else {echo 'disabled';} ?> class="category" name="category" value="Apparel"> Apparel &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" <?php if($mcateg==="GROOMING"){ echo 'checked';} else {echo 'disabled';} ?> class="category" name="category" value="Wellness"> Wellness &nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="">OFFICE ADDRESS : </label>
        
                                    <button type="button" id="office-cancel" class="btn btn-sm pull-right cancel-btn no-display" onClick="display('office-label','office-address','office-cancel','office-edit')">Cancel</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="office-edit" class="btn btn-sm pull-right edit-btn" title="<?php if($role==='MASTER')	echo $row1['office_address']; if($role==='SLAVE') echo $row1['address'];?>" onClick="display('office-address','office-label','office-edit','office-cancel',this.title);">Edit</button>
                                    <div id="office-label">
									<?php 
											if($role==='MASTER')
												echo $row1['office_address'];
											if($role==='SLAVE') 
												echo $row1['address'];   
									?>
									</div>
                                    <textarea id="office-address" name="address" class="form-control text-area no-display" id="">
									<?php 
                                     if($role==='MASTER')
										echo $row1['office_address'];
									 if($role==='SLAVE') 
										echo $row1['address'];   
                                     ?>
									 </textarea>
                                </div>
                                <br>
                                <div class="form-group">
									<?php if($role==='SLAVE')
											{ ?>
                                    <label for="">YOUR NAME : </label>
                                    <button type="button" id="name-cancel" class="btn btn-sm pull-right cancel-btn no-display" onClick="display('name-label','name','name-cancel','name-edit')">Cancel</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="name-edit" class="btn btn-sm pull-right edit-btn" title="<?php echo $row1['name'];?>"  onClick="display('name','name-label','name-edit','name-cancel',this.title)">Edit</button>
                                    <div id="name-label">
									<?php 
										echo $row1['name'];        
									?>
									</div>
                                    <input id="name" name="name" type="text" class="form-control text-area no-display" id="" contenteditable="true" value="<?php echo $row1['name'];?>">
									<?php } ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="">YOUR CONTACT NUMBER : </label>
                                    <button type="button" id="contact-cancel" class="btn btn-sm pull-right cancel-btn no-display" onClick="display('contact-label','contact','contact-cancel','contact-edit')">Cancel</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="contact-edit" class="btn btn-sm pull-right edit-btn" title="<?php if($role==='MASTER') echo $row1['cp_phone']; if($role==='SLAVE') echo $row1['contact'];?>" onClick="display('contact','contact-label','contact-edit','contact-cancel',this.title)">Edit</button>
                                    <div id="contact-label">
									<?php 
										if($role==='MASTER')
											echo $row1['cp_phone']; 
										if($role==='SLAVE') 
											echo $row1['contact'];
                                        ?>
									</div>
                                    <input id="contact" name="contact" type="text" size="10" pattern="(\+?\d[- .]*){10,11}" title="Mobile number or local phone(eg.012-34567891)" class="form-control text-area no-display" id="" value="<?php 
										if($role==='MASTER')
											echo $row1['cp_phone']; 
										if($role==='SLAVE') 
											echo $row1['contact'];           
                                   
                                    ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="">YOUR EMAIL ID : </label>
                                    <button type="button" id="email-cancel" class="btn btn-sm pull-right cancel-btn no-display" onClick="display('email-label','email','email-cancel','email-edit')">Cancel</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="email-edit" class="btn btn-sm pull-right edit-btn" title="<?php echo $row1['email']; ?>" onClick="display('email','email-label','email-edit','email-cancel',this.title)">Edit</button>
                                    <div id="email-label"><?php echo $row1['email']; ?></div>
                                    <input id="email" type="email" name="email" class="form-control text-area no-display" contenteditable="true" id="" value="<?php echo $row1['email']; } ?>">
									<?php  echo'<input type="hidden" name="slaveid" value="';echo $mid;echo'">';?>
                                </div>
								<!--   here start -->
								<?php    
										if($role==='SLAVE') 
										{ 
											if($mcateg==='FOOD')
											{
													$qyee="Select * from category_food where slave_id='$mid'";
													$res349=mysqli_query($mysqli,$qyee);
													while($row349=mysqli_fetch_array($res349))
													{
														$sub_cat=$row349['sub_categorie'];
														$recdish=$row349['recommended_dish'];
														$high=$row349['highlights'];
														$closed_days=$row349['closed_days'];
														$open_time=$row349['open_time'];
														$close_time=$row349['close_time'];

													}

													echo '<div class="form-group">
													      <label for="">TYPE OF OUTLET: </label>
														  <br>';
													echo '<input type="hidden" value="FOOD" name="categoryidentifier">';													
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="availoption[]" class="availoption" id="inlineCheckbox1" value="QUICKBITE" ';if(isset($sub_cat))if (strpos($sub_cat,"QUICKBITE") !== false){echo 'checked';}echo ' >QUICKBITE</label>';													
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="availoption[]" class="availoption" id="inlineCheckbox1" value="RESTRO" '; if(isset($sub_cat)) if (strpos($sub_cat,"RESTRO") !== false) {echo 'checked';}echo '>RESTRO</label>';													
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="availoption[]" class="availoption" id="inlineCheckbox1" value="BAR" '; if(isset($sub_cat)) if (strpos($sub_cat,"BAR") !== false) {echo 'checked';}echo '>BAR</label></br>';

													echo '</div>
														  <div class="form-group">
													      <label for="">HIGHLIGHTS: </label>
														  <br>';													
													echo '<label class="checkbox-inline">';
													echo'<input title="sud335" type="checkbox" name="highlights[]" class="availoption" id="inlineCheckbox1" value="WIFI" '; if(isset($recdish)) if (strpos($recdish,"WIFI") !== false) {echo 'checked';}echo '>WIFI</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="highlights[]" class="availoption" id="inlineCheckbox1" value="DINE-IN" '; if(isset($recdish)) if (strpos($recdish,"DINE-IN") !== false) {echo 'checked';}echo '>DINE IN</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="highlights[]" class="availoption" id="inlineCheckbox1" value="NON-VEG" '; if(isset($recdish)) if (strpos($recdish,"NON-VEG") !== false) {echo 'checked';}echo '>NON VEG</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="highlights[]" class="availoption" id="inlineCheckbox1" value="ALC" '; if(isset($recdish)) if (strpos($recdish,"ALC") !== false) {echo 'checked';}echo '>ALC</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="highlights[]" class="availoption" id="inlineCheckbox1" value="TAKE-OUT" '; if(isset($recdish)) if (strpos($recdish,"TAKE-OUT") !== false) {echo 'checked';}echo '>TAKE OUT</label><br/>';
													
													echo'  	<br>
															<div class="form-group">
															<label for="" class="control-label">RECOMMENDED OPTIONS : </label>
															<label class="checkbox-inline text-left">
															<input type="text" name="recommendoptions" class="form-control" value="';if (isset($recdish))echo $recdish; echo'" data-role="tagsinput" />
															</label>
                                                            </div>';
															
													/*echo'  	<br>
															<div class="form-group">
																<label for="" class="control-label">HIGHLIGHTS : </label>
																<label class="checkbox-inline text-left">
																	<input type="text" name="recommendoptions" class="form-control" value="';if (isset($high)) echo $high; echo'" data-role="tagsinput" />
																</label>
                                                            </div><br/>';*/
											}
											else if($mcateg==='GROOMING')
											{
                                                    $qyee="Select * from category_wellness where slave_id='$mid'";
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
													echo '
														  <div class="form-group">
													      <label for="">FACILITY AVAILABLE: </label>
														  <br>';	

													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="sub_category[]" class="availoption" id="inlineCheckbox1" value="SPA" '; if(isset($sub_cat)) if (strpos($sub_cat,"SPA") !== false) {echo 'checked';}echo '>Spa</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="sub_category[]" class="availoption" id="inlineCheckbox1" value="SALOON" ';if(isset($sub_cat)) if (strpos($sub_cat,"SALOON") !== false) {echo 'checked';}echo '>Saloon</label>';
													echo '</div>
														  <div class="form-group">
													      <label for="">TYPE OF OUTLET: </label>
														  <br>';
													
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="subsub_category[]" class="availoption" id="inlineCheckbox1" value="UNISEX" ';if(isset($subsubcat)) if (strpos($subsubcat,"UNISEX") !== false) {echo 'checked';}echo ' >Unisex</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="subsub_category[]" class="availoption" id="inlineCheckbox1" value="MEN" ';if(isset($subsubcat)) if (strpos($subsubcat,"MEN") !== false) {echo 'checked';}echo '>Men</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="subsub_category[]" class="availoption" id="inlineCheckbox1" value="WOMEN" ';if(isset($subsubcat)) if (strpos($subsubcat,"WOMEN") !== false) {echo 'checked';}echo '>Women</label><br/><br/>';
											}
											else if($mcateg==='APPAREL')
											{
                                                    $qyee="Select * from category_apparel where slave_id='$mid'";
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
													echo '
														  <div class="form-group">
													      <label for="">PRODUCTS AVAILABLE: </label>
														  <br>
														  <br>';	

													echo '</div>
														  <div class="form-group">
													      <label for="">MEN: </label>
														  <br>';	
				
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="men[]" class="availoption" id="inlineCheckbox1" value="SHIRT" ';if(isset($smen)) if (strpos($smen,"SHIRT") !== false) {echo 'checked';}echo '>Shirt</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="men[]" class="availoption" id="inlineCheckbox1" value="JEANS" ';if(isset($smen)) if (strpos($smen,"JEANS") !== false) {echo 'checked';}echo '>Jeans</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="men[]" class="availoption" id="inlineCheckbox1" value="T-SHIRT" ';if(isset($smen)) if (strpos($smen,"T-SHIRT") !== false) {echo 'checked';}echo '>Tshirt</label><br/>';
													
													echo '</div>
														  <div class="form-group">
													      <label for="">WOMEN: </label>
														  <br>';	


													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="women[]" class="availoption" id="inlineCheckbox1" value="SHIRT" ';if(isset($swomen)) if (strpos($swomen,"SHIRT") !== false) {echo 'checked';}echo '>Shirt</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="women[]" class="availoption" id="inlineCheckbox1" value="JEANS" ';if(isset($swomen)) if (strpos($swomen,"JEANS") !== false) {echo 'checked';}echo '>Jeans</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="women[]" class="availoption" id="inlineCheckbox1" value="T-SHIRT" ';if(isset($swomen)) if (strpos($swomen,"T-SHIRT") !== false) {echo 'checked';}echo '>Tshirt</label><br/>';
													
													echo '</div>
														  <div class="form-group">
													      <label for="">KIDS: </label>
														  <br>';	

													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="kid[]" class="availoption" id="inlineCheckbox1" value="SHIRT" ';if(isset($skids)) if (strpos($skids,"SHIRT") !== false) {echo 'checked';}echo '>Shirt</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="kid[]" class="availoption" id="inlineCheckbox1" value="JEANS" ';if(isset($skids)) if (strpos($skids,"JEANS") !== false) {echo 'checked';}echo '>Jeans</label>';
													echo '<label class="checkbox-inline">';
													echo'<input type="checkbox" name="kid[]" class="availoption" id="inlineCheckbox1" value="T-SHIRT" ';if(isset($skids)) if (strpos($skids,"T-SHIRT") !== false) {echo 'checked';}echo '>Tshirt</label><br><br>';
											}

											echo'<div class="form-group">
												<label for="" class="control-label">OPEN DAYS : </label>
												<br>
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
													<div class="form-group">
														<label for="" class="control-label">TIMINGS : </label>
															
															<div class="row">
																
																<div class="col-xs-3">
																	<b>FROM:</b>
																	<div class="input-group">
																		<input type="time" name="datetimepicker1" class="datetimepicker1 form-control time" type="text" required value="'; if(isset($open_time)) echo $open_time;echo'"">
																		<div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
																	</div>
																</div>
																
																<div class="col-sm-3 text-center"></div>
																
																<div class="col-xs-3">
																	<b>TO:</b>
																	<div class="input-group">
																		
																		<input type="time" name="datetimepicker2" class="datetimepicker1 form-control time" type="text" required value="';if(isset($close_time))	echo $close_time;echo'">
																		<div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
																	</div>
																</div>
															</div>     
														
														
													</div>
                                  
												</div>';
										}
                                ?>



                                <br>
                                <input type="submit" class="btn btn-default" onclick="loading()" value="Submit">
                                <button type="reset" class="btn btn-default">Reset</button>
                                <span id="loading"class="no-display" style="color:#093">loading</span>
                            </form>
                        
                            </div>
						</div>
                </div>
		</div>
		
        <!-- #############################  MIDDLE COL ENDS ############################### -->
        <!-- #############################  RIGHT COL STARTS ############################### -->
           <div class="col-md-3 right-col" style="width:20%;">
			        <div class="right-content">
            <!-- #############################  UPLOAD IMAGE STARTS ############################### -->
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 profile-img">
                    
                   <form method="post" enctype="multipart/form-data" action="logo.php">
                      
                        <?php 
								$result = mysqli_query($mysqli,"SELECT * FROM `$table` WHERE `$where` = '$mid'");
								while($row = mysqli_fetch_array($result)){      
                         
                       ?>
					   <label for="file">
						<img src="logo/<?php echo $row['logo'];  ?>" alt="Add new Image" title ="Click to add a new image" class="img-thumbnail add-logo" width="100%" style="height:126px" >
                       <br>
					   <br>
						<div style="height:0px;overflow:hidden">
							<input type="file" name="file" id="file" onchange="document.getElementById('uploadLogo').value = this.value; $('#uploadLogo').removeClass('no-display');" placeholder="Select Logo" required>
						</div>
					   <input id="uploadLogo" placeholder=" File Name " size="12" class="form-control text-area no-display" />						
                       <input type="hidden" value="<?php echo $mid; ?>" name="id">
                       <input type="hidden" value="<?php echo $role; ?>" name="role">

					   </label>
                       <button type="submit" class="btn btn-primary" onChange="$('#uploadLogo').addClass('no-display');" >UPLOAD LOGO</button>
                    </form>
                </div>
            </div>
            
			<div class="col-md-2">
            </div>
            <!-- #############################  UPLOAD IMAGE ENDS ############################### -->

            <!-- <div class="row">
                <div class="col-md-12 col-xs-offset-2">
                    <i class="glyphicon glyphicon-briefcase"></i> <?php echo $row['propriety_name'];  } ?>
                </div>
            </div>-->


            
            <!-- #############################  DISPLAY IMAGES STARTS ############################### -->
<?php if($role==='SLAVE' && $mcateg!=='APPAREL')
		{ 
			if($mcateg==='GROOMING')
			{
			?>
			<div class="row">
                <div class="col-md-12 col-xs-offset-1">
                    <i class="glyphicon glyphicon-briefcase"></i> <b>RATE-LIST IMAGES :</b>
					<?php $type="RATELIST"?>
                </div>
            </div>
			<br>
            <div class="row">
                <div class="col-md-12  col-xs-offset-1 thumb-img">				
                    <form method="post" enctype="multipart/form-data"action="uploadimage.php">
						<label for="picture">

							<img src="images/add.png" alt="Add new Image" title ="Click to add a new image" class="img-thumbnail add-logo" width="80%">
							<br>
							<br>
							<div style="height:0px;overflow:hidden">
								<input type='file' name="files[]" id="picture" multiple="multiple" onchange="document.getElementById('uploadFile').value = this.value; $('#uploadFile').removeClass('no-display');" required>
							</div>
							<input id="uploadFile" placeholder=" File Name " size="10" class="form-control text-area no-display" />
							<input type="hidden" name="id" value="<?php echo $mid; ?>">
							<input type="hidden" name="type" value="<?php echo $type; ?>">
								
                       </label>
                <button class="btn btn-primary" type="submit" onChange="$('#uploadFile').addClass('no-display');">UPLOAD IMAGE</button>
				<br>
                    </form>
                </div>
               
                <?php 
                    $result = mysqli_query($mysqli,"SELECT * FROM menu_ratelist WHERE slave_id = '$mid' AND type = '$type'");
					while($row = mysqli_fetch_array($result))
					{      
                          ?>
                
                 <div class="col-md-4 thumb-img ">
                    <img src="images/upload/<?php echo $row['pic']; ?>" alt="img2" class="img-responsive img-thumb" width="100%">
				</div>
			<?php		}?>
            </div>                
		
			
			<?php }
			
			if($mcateg==='FOOD')
			{
			?>
			<!------ RESTRO IMAGES FOR FOOD CATEGORIE:----->
			<div class="row">
                <div class="col-md-12 col-xs-offset-1">
                    <i class="glyphicon glyphicon-briefcase"></i> <b>RESTRO MENU IMAGES :</b>
					<?php $type="FOOD"?>
                </div>
            </div>
			<br>
            <div class="row">
                <div class="col-md-12  col-xs-offset-1">				
                    <form method="post" enctype="multipart/form-data"action="uploadimage.php">
						<label for="picture">

							<img src="images/add.png" alt="Add new Image" title ="Click to add a new image" class="img-thumbnail add-logo" width="80%">
							<br>
							<br>
							<div style="height:0px;overflow:hidden">
								<input type='file' name="files[]" id="picture" multiple="multiple" onchange="document.getElementById('uploadFile').value = this.value;  $('#uploadFile').removeClass('no-display');" required>
							</div>
							<input id="uploadFile" placeholder=" File Name " size="12" class="form-control text-area no-display" />
							<input type="hidden" name="id" value="<?php echo $mid; ?>">
							<input type="hidden" name="type" value="<?php echo $type; ?>">							

                       </label>
                <button class="btn btn-primary" type="submit" onChange="$('#uploadFile').addClass('no-display');">UPLOAD IMAGE</button>
				<br>
                    </form>
                </div>
               
                <?php 
                    $result = mysqli_query($mysqli,"SELECT * FROM menu_ratelist WHERE slave_id = '$mid' AND type = '$type'");
					while($row = mysqli_fetch_array($result))
					{      
                          ?>
                
                 <div class="col-md-4 thumb-img ">
                    <img src="images/upload/<?php echo $row['pic']; ?>" alt="img2" class="img-responsive img-thumb" width="100%">
				</div>
			<?php		}?>
            </div>
			<br>
			<!------ BAR IMAGES FOR FOOD CATEGORIE:----->
			<div class="row">
                <div class="col-md-12 col-xs-offset-1">
                    <i class="glyphicon glyphicon-briefcase"></i> <b>BAR MENU IMAGES :</b>
                </div>
				<?php $type="BAR"?>
            </div>
			<br>
            <div class="row">
                <div class="col-md-12  col-xs-offset-1">				
                    <form method="post" enctype="multipart/form-data"action="uploadimage.php">
						<label for="fileb">

							<img src="images/add.png" alt="Add new Image" title ="Click to add a new image" class="img-thumbnail add-logo " width="80%">
							<br>
							<br>
							<div style="height:0px;overflow:hidden">
								<input type='file' name="files[]" id="fileb" multiple="multiple" onchange="document.getElementById('uploadFileb').value = this.value; $('#uploadFileb').removeClass('no-display');" required>
							</div>
							<input id="uploadFileb" placeholder=" File Name " size="10" class="form-control text-area no-display"  />
							<input type="hidden" name="id" value="<?php echo $mid; ?>">
							<input type="hidden" name="type" value="<?php echo $type; ?>">							
	
                       </label>
						<button class="btn btn-primary" type="submit" onChange="$('#uploadFileb').addClass('no-display');">UPLOAD IMAGE</button>
						<br>
                    </form>
                </div>
               
                <?php 
                    $result = mysqli_query($mysqli,"SELECT * FROM menu_ratelist WHERE slave_id = '$mid' AND type = '$type'");
					while($row = mysqli_fetch_array($result))
					{      
                          ?>
                
                 <div class="col-md-4 thumb-img ">
                    <img src="images/upload/<?php echo $row['pic']; ?>" alt="img2" class="img-responsive img-thumb" width="100%">
				</div>
			<?php		}?>
            </div>           
			
			

               
		<?php		
                
			}
		}?>
            <!-- #############################  DISPLAY IMAGES STARTS ############################### -->

           </div>
        </div>
        <!-- #############################  RIGHT COL ENDS ############################### -->


    <!-- #############################  MAIN CONTAINER ENDS ############################### -->

    <!-- #############################  JAVASCRIPTS STARTS ############################### -->

    <script src="js/bootstrap.min.js"></script>
	
    <!-- Bootstrap script -->
    <!-- #############################  JAVASCRIPTS ENDS ############################### -->

    <script>
	function display(show, hide, btnhide, btnshow,val)
	{
		var show = show;
		var hide = hide;
		var btnshow = btnshow;
		var btnhide = btnhide;
		//console.log(val);
		$("#"+hide).addClass('no-display');
		$("#"+show).removeClass('no-display');
		
		//console.log(btnshow);
		//console.log(btnhide);
		$("#"+btnhide).addClass('no-display');
		$("#"+btnshow).removeClass('no-display');
		var form = document.getElementById(show);
		form.value=val;
		
		
	}
	
	function checkDisplay(value)
	{
		 $("."+value).removeAttr("disabled");
		 $('#category-cancel').removeClass("no-display");
		 $('#category-edit').addClass("no-display");
		 
	}
	
	function checkUndisplay(value)
	{
		 $("."+value).attr("disabled", true);
		 $('#category-edit').removeClass("no-display");
		 $('#category-cancel').addClass("no-display");
	}
	</script>
    
    <script>
	
	function loading()
	{
		 $('#loading').removeClass("no-display");
		var originalText = $("#loading").text(),
		
    i  = 0;
setInterval(function() {

    $("#loading").append(".");
    i++;
    
    if(i == 4)
    {
        $("#loading").html(originalText);
        i = 0;
    }

}, 500);
	}
	</script>
</body>

</html>
<?php } 
else
    header('Location:index.php');
?>