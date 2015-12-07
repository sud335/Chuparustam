<!DOCTYPE html>
<?php
session_start();
if(!empty($_SESSION['uname']))
    {
include_once("common_code/userdb.inc.php");

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
                    <li class="active"><a href="redeem.php"><i class="glyphicon glyphicon-send"></i>&nbsp;&nbsp; REDEEM</a>
                    </li>
                    <li><a href="info.php"><i class="glyphicon glyphicon glyphicon-hdd"></i>&nbsp;&nbsp; INFO</a>
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
            <br>
            <br>	
            <div class="col-md-10 col-xs-offset-1">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" value="" id="id_search" placeholder="Enter Name Or Unique ID">
                        <span class="input-group-btn">
								<button class="btn btn-default label-default" type="button"><div class="glyphicon glyphicon-search"></div><strong> Search</strong></button>
						</span>
                    </div>
                </div>
                
                <table>
                    <?php
										$user =  $_SESSION['uname'];
										$result = mysqli_query($mysqli,"SELECT * FROM merchant_login WHERE uname = '$user'");
										
										while($row = mysqli_fetch_array($result))
										{
													$mid = $row['merchant_id'];
													$role=$row['role'];
										}

										$confirm = 0;
										$result = mysqli_query($mysqli,"SELECT * FROM offers_activated WHERE confirmed = '$confirm'");
										while($row = mysqli_fetch_array($result))
										{
											$offer_id = $row['offer_id'];   
											$user_id = $row['user_id'];
        
											$res = mysqli_query($mysqli,"SELECT * FROM offers WHERE offer_id = '$offer_id'");
											while($row1 = mysqli_fetch_array($res))
											{
												$slave_id = $row1['slave_id']; 
												$offer_desc = $row1['offer_desc'];
											       
									
											if($slave_id==$mid)//for offers under slaves
											{
     
												$res1 = mysqli_query($mysqli,"SELECT * FROM users WHERE user_id = '$user_id'");
												while($row2 = mysqli_fetch_array($res1))
												{
  
														$timestamp = $row['activated_at'];
		
														date_default_timezone_set("Asia/Kolkata"); 
            
														$time = date('H:i:s', strtotime($timestamp));
														$timestamp = strtotime($timestamp);
					?>
												<tr>	
													<td>
														<div class="col-md-12 search-result">
															<div class="box-border">
															
																<div class="col-md-12 search-content">
																	<img src="images/user.png" alt="user-img" title="user-name" class="search-img">
																		<div class="search-name">
																			<h3><strong><?php echo $row2['name']; ?></strong> <?php echo substr($row2['name'], 0, 3)."cr00".$user_id; ?></h3>
																			<strong>Activated</strong> offer at <strong><?php echo $time; ?></strong> on <strong><?php echo date("m-d-Y", $timestamp); ?></strong>
																		</div>
																		<div class="search-text">
																			<?php echo $offer_desc;  ?>
																		</div>
    
																</div>
														
																<div class="col-md-12">
                                        
                    <?php   
							
																echo '<a href="confirm.php?offer_id='.$offer_id.'&user_id='.$user_id.'">
																		<button type="button" class="btn btn-primary confirm">
																			<div class="glyphicon glyphicon-thumbs-up"></div> CONFIRM
																		</button>
																	</a>';
                                        ?>
                                        
                                        
                                
																</div>     
															</div>    
														</div>
													</td>
												</tr>

     
     
     <?php
												}
        
											}
										
											else
											{

													$result1 = mysqli_query($mysqli,"SELECT * FROM merchant_slave WHERE slave_id = '$slave_id'");
													
													while($row4 = mysqli_fetch_array($result1))
														$master_id = $row4['master_id'];

														if(isset($master_id))
														{
																if($master_id==$mid)
																{
    
																	$res1 = mysqli_query($mysqli,"SELECT * FROM users WHERE user_id = '$user_id'");
																	while($row2 = mysqli_fetch_array($res1))
																	{
  
																			$timestamp = $row['activated_at'];

																			date_default_timezone_set("Asia/Kolkata"); 
          
																			$time = date('H:i:s', strtotime($timestamp));
        
																			$timestamp = strtotime($timestamp);
   ?>
																			<tr>
																				<td>
																					<div class="col-md-12 search-result">
																						<div class="box-border">
																							<div class="col-md-12 search-content">
																									<img src="images/user.png" alt="user-img" title="user-name" class="search-img">
																									<div class="search-name">
																										<h3><strong><?php echo $row2['name']; ?></strong> <?php echo substr($row2['name'], 0, 3)."cr00".$user_id; ?></h3>
																										<strong>Activated</strong> offer at <strong><?php echo $time; ?></strong> on <strong><?php echo date("m-d-Y", $timestamp); ?></strong>
																									</div>
																									
																									<div class="search-text">
																										<?php echo $offer_desc;  ?>
																									</div>
    
																							</div>
																							
																							<div class="col-md-12">                        
                                        
                                        <?php
																									echo '<a href="confirm.php?offer_id='.$offer_id.'&user_id='.$user_id.'"><button type="button" class="btn btn-primary confirm">
																											<div class="glyphicon glyphicon-thumbs-up"></div> CONFIRM
																										  </button></a>';
                                        ?>
                                        
                                        
                                
																							</div>     
																						</div>    
																					</div>
																				</td>
																			</tr>

										<?php
																	}
																}
														}
																
											}//master ends
            
										}
								}//while main ends

    
                    ?>
    
   
                </table>
            </div>
        </div>
     <!-- #############################  MIDDLE COL ENDS ############################### -->
     <!-- #############################  RIGHT COL STARTS ############################### -->    
   
    <!-- #############################  RIGHT COL ENDS ############################### -->    
    
    </div>

<!-- #############################  MAIN CONTAINER ENDS ############################### -->    
	
<!-- #############################  JAVASCRIPTS STARTS ############################### -->    

    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap script -->
    <script type="text/javascript" src="js/jquery.quicksearch.js"></script> <!-- Search script -->
    <script type="text/javascript">
        $(function() {
            /*
				Search script function
				*/
            $('input#id_search').quicksearch('table tbody tr');
        });
    </script>
<!-- #############################  JAVASCRIPTS ENDS ############################### -->      
</body>

</html>
<?php } 
else
    header('Location:index.php');
?>