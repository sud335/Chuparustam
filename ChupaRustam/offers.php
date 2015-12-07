<?php
session_start();
if(!empty($_SESSION['uname']))
    {
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
                    <li class="active"><a href="offers.php"><i class="glyphicon glyphicon glyphicon-bullhorn"></i>&nbsp;&nbsp; OFFERS</a>
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
                 <div class="col-lg-12" style="background:#FFF;padding:20px;">
                       <div class="form-group">
                      	 <div class="col-sm-12">
                     	  <button type="button" class="btn btn-primary btn-lg confirm" data-toggle="modal" data-target="#add-new-offer"><div class="glyphicon glyphicon-edit"></div> ADD NEW OFFERS</button>
                       </div>
                       </div>
                 </div>
				<?php
					
					include_once("common_code/userdb.inc.php");
					$user =  $_SESSION['uname'];
				$result = mysqli_query($mysqli,"SELECT * FROM merchant_login WHERE uname = '$user'");
				while($row = mysqli_fetch_array($result))
				{
						$mid = $row['merchant_id'];
						$role=$row['role'];
				}				
				?>
                 
                 <!-- Add NEW OFFERS POP UP -->
                    <div class="modal fade" id="add-new-offer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<h4 class="modal-title text-center" id="myModalLabel">ADD OFFER</h4>
								</div>
								<!--modal body-->
								<div class="modal-body">
									<form class="form-horizontal" role="form" action="addoffer.php" id="form" title="<?php if($role==='SLAVE'){echo 1;} if($role==='MASTER') {echo 0;}?>" onSubmit="return validation(this.title)" method="POST">
										<div class="form-group col-md-12">
											<div>
											<textarea name="description" class="form-control" id="" placeholder="Enter Description" required></textarea>
											</div>
										</div>
                                  
										<div class="form-group col-md-12" style="margin-left: 60px;">
											<?php  													
													if($role==='SLAVE')
													{
   
														$result = mysqli_query($mysqli,"SELECT * FROM merchant_slave WHERE slave_id = '$mid'");
														while($row = mysqli_fetch_array($result))
															$master_id = $row['master_id'];
    
														$result = mysqli_query($mysqli,"SELECT * FROM merchant_master WHERE master_id = '$master_id'");
														while($row = mysqli_fetch_array($result))
															$category = $row['categorie'];
													
													}

													if($role==='MASTER')
													{
   
														$result = mysqli_query($mysqli,"SELECT * FROM merchant_master WHERE master_id = '$mid'");
														while($row = mysqli_fetch_array($result))
															$category = $row['categorie'];
													}
													
                                   
													if ($category==='APPAREL')
													{
											?>
											<!--Apparel category-->
														<label class="checkbox-inline"><input type="checkbox" class="category" name="category[]" id="inlineCheckbox1" value="MEN"> MEN</label>
														<label class="checkbox-inline"><input type="checkbox" class="category" name="category[]" id="inlineCheckbox1" value="WOMEN"> WOMEN</label>
														<label class="checkbox-inline"><input type="checkbox" class="category" name="category[]" id="inlineCheckbox1" value="KIDS"> KIDS</label>
														
											<?php   
													}	
													if ($category==='FOOD')
													{
											?><!--Food category-->
														<label class="checkbox-inline"><input type="checkbox" class="category" name="category[]" id="inlineCheckbox1" value="QUICKBITE"> QUICKBITE</label>
														<label class="checkbox-inline"><input type="checkbox" class="category" name="category[]" id="inlineCheckbox1" value="RESTRO"> RESTRO</label>
														<label class="checkbox-inline"><input type="checkbox" class="category" name="category[]" id="inlineCheckbox1" value="BAR"> BAR</label>
											<?php   
													}
													if ($category==='GROOMING')
													{
											?>
														<label class="checkbox-inline"><input type="checkbox" class="category" name="category[]" id="inlineCheckbox1" value="SPA"> SPA</label>
														<label class="checkbox-inline"><input type="checkbox" class="category" name="category[]" id="inlineCheckbox1" value="SALOON"> SALOON</label>
											<?php   
													}
											?>
                                                                            
									</div><!--inner body modal tag-->
                                 <?php
                                      if($role==='MASTER')
									  {
									?>        
										<div class="form-group col-md-12">  
											<label for="" class="col-sm-3 control-label text-left" style="padding-left: 0px;padding-top:14px;">AVAILABLE AT : </label>
											 
											<label class="checkbox-inline">
													<input type="checkbox" class="outlet" name="outlet" id="inlineCheckbox1" value="option1"> ALL Outlets
											</label>
											
											<label class="checkbox-inline">
												<select id="example-getting-started" name="outlets[]" class="selectoutlet" multiple="multiple" >
												<?php
														$result = mysqli_query($mysqli,"SELECT * FROM merchant_slave WHERE master_id = '$mid'");
														$count=0;
														while($row = mysqli_fetch_array($result))
														{	
												?>
                                         
															<!--<option value="<?php echo $row['slave_id']?>"><?php echo $row['name'].",".substr($row['address'], 0, 4);?></option>-->
															<option value="<?php echo $row['slave_id']?>" <?php if($count===0) echo 'selected="selected"'?>><?php echo $row['name'].",".$row['address'];?></option>
												<?php		$count=$count+1;
														}
														$count=0;
												?>
												</select>
											</label>
                                   
										</div>
                                
                                <?php
                                          
                                      }
								?>
                                  
										<div class="form-group col-md-12">
											<label for="" class="col-sm-3 control-label text-left" style="padding-top:18px;">EXPIRATION : </label>
											<label class="checkbox-inline">
											<input type="date" id="" name="expiry" min ="<?php echo date('Y-m-d');?>"required>
											</label>
											<label class="checkbox-inline">
												<input type="checkbox" id="inlineCheckbox1" name="exclusive" value="1"> Exclusive
											</label>
                                   
										</div>
                                  
										<div class="form-group col-md-12">
											<div>
												<label for="" class="control-label " >TERMS AND CONDITIONS : </label>
												<button class="pull-right" onclick="document.getElementById('textbox1').value = '';"><i class="glyphicon glyphicon-retweet"></i> Reset </button>
											</div>
										</div>
                                  
										<div class="form-group col-md-12">
											<div>
												<textarea class="form-control" id="textbox1" name="terms" required>Here is the TERMS AND CONDITIONS default text</textarea>
											</div>
										</div> 
                                  
										<div class="form-group">
		
										</div>
                                  
                                
								</div><!--Body of modal div-->
							
								<!--modal footer div-->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" onclick=this.form.reset(); data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary" name="submit">Save</button>
								</div>
							</form>   
                        </div><!--modal content div-->
                      </div><!--modal diag div-->
                    </div><!--modal div-->
                  <!-- END Add NEW OFFERS POP UP -->
				  
				  
				  
				  
				  
                 <div class="col-lg-12" style="margin-top:15px;padding:20px;">
                     <table id="table" width="100%">
                        <tr id="boxtr1">
                            <td> 
                            <?php 
    
								if($role==="SLAVE")
								{
										$query2="SELECT * FROM `merchant_offers` WHERE `merchant_id`='$mid' ORDER BY `created_at` DESC";
										$res1 = $mysqli->query($query2);

                                  
										while( $row1 = $res1->fetch_assoc())
										{
											$id=$row1['offer_id']; 
											$description=$row1['offer_desc'];
											$terms=$row1['terms'];
	
											//display offers
											echo '<script>function abc(x,y){ alert("are you sure you want to delete the offer??"); location.href="deleteoffer.php?id="+x+"&sid="+y;}</script>';
											echo '<tr id="boxtr1">
												<td> 
												<div class="col-lg-12 search-result" style="padding:20px;height:auto">
													<div class="box-offers">
														<form class="form-horizontal" role="form">
															<div class="pull-right">                                  
																<button type="button" data-toggle="modal" data-target="#edit-offer';echo $id;echo '"><a><i class="glyphicon glyphicon-pencil" ></i></a></button>
																<button type="button" onClick="abc(';echo $id;echo ',';echo $mid;echo');"><i class="glyphicon glyphicon-remove" ></i></button>
															</div>
															
															<br><br>   
															<div class="form-group col-md-12">
																<div class="offer-description">'; echo $description; echo' 
																</div>
															</div>
															
															<div class="form-group col-md-12">
																<label class="checkbox-inline">';
																	echo $row1['offer_categorie'];echo' 
																</label>
															</div>
															
                                  
															<div class="form-group col-md-12">
																<label for="" class="col-sm-4 control-label text-left">EXPIRATION : 
																</label>
																<label class="checkbox-inline">';
																		echo $row1['expiry'];echo'
																</label>
															</div>
															
															<div class="form-group col-md-12">
																<div>
																	<button type="button" class="pull-right" data-toggle="modal" data-target="#terms-and-condition';echo $id;echo '">Terms & Conditions </button>
																</div>
															</div>
															<div class="form-group">
															</div>
														</form>   
													</div>     
												</div>
												';
											
											//to edit offers
											$q="Select * from merchant_slave where slave_id = '$mid'";
											$res2 = $mysqli->query($q);
											while( $row2 = $res2->fetch_assoc())
											{
												$masterid=$row2['master_id'];
											}                       
											
											$q ="Select * from merchant_master where master_id='$masterid'"; 
											$res3 = $mysqli->query($q);
											while( $row3 = $res3->fetch_assoc())
											{
												$mcateg=$row3['categorie'];
											}      
                          
                              
									//edit-offers
									echo '<div class="modal fade" id="edit-offer';echo$id;echo'"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                    
											echo '<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																	<h4 class="modal-title text-center" id="myModalLabel">EDIT OFFER</h4>
															</div>
															
															<div class="modal-body">';
															//modal- body starts
															echo' <form class="form-horizontal" role="form" action="updateoffer.php" method="POST">';
																echo '<div class="form-group col-md-12">
																			<div>
																				<textarea class="form-control" id="" placeholder="Enter Description" required name="description">';
																				echo $description; echo'
																				</textarea>
																			</div>
																	   </div>
                                  
																		<div class="form-group col-md-12" style="margin-left: 60px;">';
																			$category=$row1['offer_categorie'];
																			if($mcateg==="FOOD")
																			{
																					echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="QUICKBITE" ';if (strpos($category,"QUICKBITE") !== false) {echo 'checked';}echo '>QUICKBITE
																						  </label>';
																					
																					echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="RESTRO"';if (strpos($category,"RESTRO") !== false) {echo 'checked';}echo '>RESTRO
																						   </label>';	
																						   
																					echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="BAR"';if (strpos($category,"BAR") !== false) {echo 'checked';}echo '>BAR
																						  </label>';
																			}
																			
																			if($mcateg==="GROOMING")
																			{
																					echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="SPA"';if (strpos($category,"SPA") !== false) {echo 'checked';}echo '>SPA
																						  </label>';
																					
																					echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="SALOON"';if (strpos($category,"SALOON") !== false) {echo 'checked';}echo '>SALOON
																						  </label>'; 
																			}
																			
																			if($mcateg==='APPAREL')
																			{
																					echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="MEN"';if (strpos($category,"MEN") !== false) {echo 'checked';}echo '>MEN
																						  </label>';
																						  
																					echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="WOMEN"';if (strpos($category,"WOMEN") !== false) {echo 'checked';}echo '>WOMEN
																						 </label>';
																					echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="KIDS"';if (strpos($category,"KIDS") !== false) {echo 'checked';}echo '>KIDS
																						  </label>'; 
																			}	
                                 
																			$exclusive=$row1['exclusive'];
                             
                                    
																			echo '<input type="hidden" value="';echo$id;echo'" name="slave_id"> ';         
																			echo' 
																	    </div><!--categ div end-->
                                 
                            
                                  
																	<div class="form-group col-md-12">
																			<label for="" class="col-sm-3 control-label text-left">EXPIRATION : </label>
																			<label class="checkbox-inline">
																			<input type="date" id="" name="expiry" min ="';echo date('Y-m-d');echo'" value="'; echo $row1['expiry']; echo'"  required>
																			</label>
																			
																			<label class="checkbox-inline">
																			<input type="checkbox" name="exclusive" id="inlineCheckbox1" value="';echo $exclusive; echo'" '; if($exclusive=="1"){echo 'checked';}echo'> Exclusive
																			</label>
									
																	</div>';?>
                                  
																	
																				
																	<div class="form-group col-md-12">
																		<div>
																			<label for="" class="control-label " >TERMS AND CONDITIONS : </label>
																			<button class="pull-right" onclick="document.getElementById('textbox2').value = ''"><i class="glyphicon glyphicon-retweet"></i> Reset </button>
																		</div>
																	</div>
									
																	<div class="form-group col-md-12">
																		<div>
																			<textarea class="form-control" id="textbox2" name="terms" required><?php echo $terms;?></textarea>
																		</div>
																	</div> 
                                  
																<?php echo'<div class="form-group">
																	</div>
														</div><!--modal body ends here-->
							
														<div class="modal-footer">
																<button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary" name="save" onclick="location.href=updateoffer.php">Save</button>
														</div>
											</div><!--modal content ends here-->
										</form>
									</div><!--modal diag end div-->
								</div><!--modal rnd div-->
							</td>
						</tr> 
                  <!-- END EDIT OFFERS POP UP --> ';
                       
            echo '   <!-- TERMS AND CONDITION POP UP -->
                    <div class="modal fade" id="terms-and-condition';echo$id;echo'""  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">TERMS AND CONDITIONS</h4>
                          </div>
                          <div class="modal-body">
                            <p>';
                            echo $terms;
                            echo '</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
					
                  <!-- END TERMS AND CONDITION POP UP -->';

                        }//while ends
                     }//SLAVE if ends 
					 
					 
						if($role==="MASTER")
						{
									$q="Select * from merchant_slave where master_id='$mid'";
									$res12 = $mysqli->query($q);  	
									while( $row12 = $res12->fetch_assoc())
									{
										
										$sid=$row12['slave_id'];
										$sname=$row12['name'];
										$query2="SELECT * FROM `merchant_offers` WHERE `merchant_id`='$sid' ORDER BY `created_at` DESC";
										$res1 = $mysqli->query($query2);
	
										while( $row1 = $res1->fetch_assoc())
										{
												$id=$row1['offer_id']; 
												$description=$row1['offer_desc'];
												$terms=$row1['terms'];
												$category=$row1['offer_categorie'];
												$exclusive=$row1['exclusive'];
												echo '<script>function abc(x,y){alert("are you sure you want to delete the offer??");location.href="deleteoffer.php?id="+x+"&sid="+y;}</script>';
												echo '<tr id="boxtr1">
													  <td> 
												<div class="col-lg-12 search-result" style="padding:20px;height:auto">
														<div class="box-offers">
															<form class="form-horizontal" role="form">
																<div class="pull-right">
																	<button type="button" data-toggle="modal" data-target="#edit-offer1';echo $id;echo '"><a><i class="glyphicon glyphicon-pencil" ></i></a></button>
																	<button type="button" onClick="abc(';echo $id;echo ',';echo $sid;echo');"><i class="glyphicon glyphicon-remove" ></i></button>
																</div>
																
																<br><br>   
																<div class="form-group col-md-12">
																	<div class="offer-description">'; echo $description; echo' 
																	</div>
																</div>
																
																<div class="form-group col-md-12">
																	<label class="checkbox-inline">';
																		echo $row1['offer_categorie'];echo' 
																	</label>
																</div>
															
																<div class="form-group col-md-12">
																	<label for="" class="col-sm-4 control-label text-left">AVAILABLE AT: 
																	</label>
																	<label class="checkbox-inline">';
																		echo $sname;echo'
																	</label>
																</div>																
                                  
																<div class="form-group col-md-12">
																	<label for="" class="col-sm-4 control-label text-left">EXPIRATION : 
																	</label>
																	<label class="checkbox-inline">';
																		echo $row1['expiry'];echo'
																	</label>
																</div>
                                 
																<div class="form-group col-md-12">
																	<div>
																		<button type="button" class="pull-right" data-toggle="modal" data-target="#terms-and-condition';echo $id;echo '">Terms & Conditions </button>
																	</div>
																</div>
																<div class="form-group">								
																</div>
															 </form> 
														</div>
													</div> ';
                  
												
												$q ="Select * from merchant_master where master_id='$mid'"; 
												$res3 = $mysqli->query($q);
												while( $row3 = $res3->fetch_assoc())
												{
															$mcateg=$row3['categorie'];

												}      
                          
                              
 
												echo '<div class="modal fade" id="edit-offer1';echo$id;echo'"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                    
													echo '<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																		<h4 class="modal-title text-center" id="myModalLabel">EDIT OFFER</h4>
																	</div>
																
																<div class="modal-body">';
																echo' <form class="form-horizontal" role="form" action="updateoffer.php" method="POST">';
																		echo '<div class="form-group col-md-12">
																				<div>
																					<textarea class="form-control" id="" placeholder="Enter Description" required name="description">';
																					echo $description; echo'
																					</textarea>
																				</div>
																			</div>
                                  
																			<div class="form-group col-md-12" style="margin-left: 60px;">';
																					//$category=$row1['offer_categorie'];
																					if($mcateg==="FOOD")
																					{
																						echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="QUICKBITE" ';if (strpos($category,"QUICKBITE") !== false) {echo 'checked';}echo '>QUICKBITE
																							  </label>';
																						
																						echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="RESTRO"';if (strpos($category,"RESTRO") !== false) {echo 'checked';}echo '>RESTRO
																							   </label>';
																						
																						echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="BAR"';if (strpos($category,"BAR") !== false) {echo 'checked';}echo '>BAR
																							  </label>';
																					}
																				
																					if($mcateg==="GROOMING")
																					{
																						echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="SPA"';if (strpos($category,"SPA") !== false) {echo 'checked';}echo '>SPA
																							  </label>';
																						
																						echo '<label class="checkbox-inline">
																								<input type="checkbox" name=category[] id="inlineCheckbox1" value="SALOON"';if (strpos($category,"SALOON") !== false) {echo 'checked';}echo '>SALOON
																							  </label>'; 
																					}
																					
																					if($mcateg==='APPAREL')
																					{
																						echo '<label class="checkbox-inline">
																									<input type="checkbox" name=category[] id="inlineCheckbox1" value="MEN"';if (strpos($category,"MEN") !== false) {echo 'checked';}echo '>MEN
																							  </label>';
																						
																						echo '<label class="checkbox-inline">
																									<input type="checkbox" name=category[] id="inlineCheckbox1" value="WOMEN"';if (strpos($category,"WOMEN") !== false) {echo 'checked';}echo '>WOMEN
																							  </label>';
																						
																						echo '<label class="checkbox-inline">
																									<input type="checkbox" name=category[] id="inlineCheckbox1" value="KIDS"';if (strpos($category,"KIDS") !== false) {echo 'checked';}echo '>KIDS
																							  </label>'; 
																					}
																			echo'</div><!-----inner modal body div-->'
																					?>
																					
																			<div class="form-group col-md-12">  
																				<label for="" class="col-sm-3 control-label text-left" style="padding-left: 0px;padding-top:14px;">AVAILABLE AT : </label>
													
																					<label class="checkbox-inline">
																							<input type="checkbox" class="outlet" name="outlet" id="inlineCheckbox1" value="option1"> ALL Outlets
																					</label>
													
																					<label class="checkbox-inline">
											
																						<select id="example-getting-started1" name="outlets[]" class="selectoutlet" multiple="multiple">
																						<?php
																								$result = mysqli_query($mysqli,"SELECT * FROM merchant_slave WHERE master_id = '$mid'");
																								while($row = mysqli_fetch_array($result))
																								{	
																						?>
                                         
															
																									<option value="<?php echo $row['slave_id']?>"><?php echo $row['name'].",".$row['address'];?></option>
																						<?php
																								}
																						?>
																						</select>
																					</label>
                                   
																			</div>
																			
																		<?php		echo '<input type="hidden" value="';echo$id;echo'" name="slave_id"> ';         
																	echo'
																		  <div class="form-group col-md-12">
																				<label for="" class="col-sm-3 control-label text-left">EXPIRATION : 
																				</label>
																				<label class="checkbox-inline">
																						<input type="date" id="" name="expiry" min ="';echo date('Y-m-d');echo'" value="'; echo $row1['expiry']; echo'"  required>
																				</label>
																				
																				<label class="checkbox-inline">
																						<input type="checkbox" name="exclusive" id="inlineCheckbox1" value="';echo $exclusive; echo'" '; if($exclusive=="1"){echo 'checked';}echo'> Exclusive
																				</label>
                                   
																			</div>'; ?>
                                  
																	<div class="form-group col-md-12">
																		<div>
																			<label for="" class="control-label " >TERMS AND CONDITIONS : </label>
																			<button class="pull-right" onclick="document.getElementById('textbox3').value = ''"><i class="glyphicon glyphicon-retweet"></i> Reset </button>
																		</div>
																	</div>
									
																	<div class="form-group col-md-12">
																		<div>
																			<textarea class="form-control" id="textbox3" name="terms" required><?php echo $terms;?></textarea>
																		</div>
																	</div> 
                                  
																	<?php echo'
																		  <div class="form-group">
																		</div>
                                  
                                   
													</div><!--div body end-->
													<div class="modal-footer">
															<button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary" name="save" onclick="location.href=updateoffer.php">Save</button>
													</div>
													</form>
											</div><!--content modal div-->
										
									</div>
								</div>
							</td>
						</tr>
                  <!-- END EDIT OFFERS POP UP --> 
                                
                         ';
                       echo '' ;
            echo '   <!-- TERMS AND CONDITION POP UP -->
                    <div class="modal fade" id="terms-and-condition';echo$id;echo'""  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">TERMS AND CONDITIONS</h4>
                          </div>
                          <div class="modal-body">
                            <p>';
                            echo $terms;
                            echo '</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <!-- END TERMS AND CONDITION POP UP -->';

										}//while ends
                            }// getting each slave for this master 
                    } //master if  
	?>
                        
                      </table> 
                  </div> 
           </div>           
        </div><!--middle column div end-->
    
     <!-- #############################  MIDDLE COL ENDS ############################### -->
     <!-- #############################  RIGHT COL STARTS ############################### -->    
        
    <!-- #############################  RIGHT COL ENDS ############################### -->    
    
    </div><!--middle column div end-->

<!-- #############################  MAIN CONTAINER ENDS ############################### -->    
	
<!-- #############################  JAVASCRIPTS STARTS ############################### -->    

    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap script -->
    <script>
    
	 function validation(val) {
		console.log(val);
		validForm = true;
		var n = $( ".category:checkbox:checked" ).length;
		var outlet = $( ".outlet:checkbox:checked" ).length;
		var selectoutlet = $( ".selectoutlet option:selected" ).length;
				var value = outlet + selectoutlet;
		
		if(n == 0)
		{
			alert('Select Atleast One Category');
			return false;
		}
		if(val===0)
		{
			if(value == 0)
			{
				alert('Select Atleast One Available At');
				return false;
			}
		}
		
	 }
	</script>
<script src="js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#example-getting-started').multiselect();
$('.example-getting-started').multiselect();
$('#example-getting-started1').multiselect();
$('.example-getting-started1').multiselect();
});

</script>

<script>
function removes(value)
{
	$('#'+value).remove();
	//console.log('#'+value);
}
</script>

 
    
 <script src="js/jquery.datetimepicker.js"></script>
    <script>
	$('.datetimepicker').datetimepicker({
	yearOffset:222,
	lang:'en',
	timepicker:false,
	format:'d/m/Y',
	formatDate:'Y/m/d',
});
	</script>
    
<!-- #############################  JAVASCRIPTS ENDS ############################### -->      
</body>

</html>
    <?php } 
else
    header('Location:index.php');
    ?>