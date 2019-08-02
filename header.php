	  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<header style="background-color:white; color:black;" id="header" id="home">
		<div class="container">
			<div class="row align-items-center justify-content-between d-flex">
				<div id="logo">
				    <a href="index.php"><img class="logo-header" src="img/logo-new.png" alt="" title="" /></a>
				</div>
				<nav style="margin-right:40px;" id="nav-menu-container">
				    <ul class="nav-menu">
				        <li class="menu-active"><a href="index.php">Home</a></li>
				        <?php 
				          	session_start();
			                include 'includes/dbh.inc.php';

			                if(isset($_SESSION['u_id']))
			                {
			                	$SESSION=$_SESSION['u_id'];

				        ?>

					    <li><a href="about_us.php">About Us</a></li>
					    <li><a href="category.php">Category</a></li>
					    <li><a href="candidate/profile.php">Dashboard</a></li>	       
					    <li class="menu-has-children">
					        <a class="nav-link" href="#"><img src="img/notification.png"  alt="notifications">
						    <?php
	                			$query = "SELECT COUNT(notif_id) as count_unread from notifications where receiver_id='$SESSION' and type='application' and status = 'unread' order by `notif_date` DESC LIMIT 5";
	                			$result=mysqli_query($conn,$query);
	                			if(mysqli_num_rows($result)>0)
	                			{
	                				while($row=mysqli_fetch_array($result))
	                				{
	                					
	                		?>
			                <span style="background-color: #ccc;" class="">&nbsp;&nbsp;<?php echo $row['count_unread']?>&nbsp;&nbsp;</span>
						    <?php
						            }
						        }
						    ?>
              				</a>
					             
					        <ul>
					        	<li>
							    <?php
		                			$query2 = "SELECT * from notifications where receiver_id='$SESSION' and type='application' order by `notif_date` DESC LIMIT 5  ";
		                				$result2=mysqli_query($conn,$query2);

		                			if(mysqli_num_rows($result2)==0)
		                			{
		                		?>
		                			<span style="font-size:14px;">You have no notifications present as of now.</span>

		                		<?php  
		                			}
		                			else
		                			{
		                				while($i=mysqli_fetch_array($result2))
		                				{
		                		?>
		                					<span id="notifbar" style ="cursor:pointer;" class="" >
						                    <a style="						                         
						        <?php
							        if($i['status']=='unread'){
							            echo "font-size:11px; font-weight:bolder;";
							        }
							        else
							        {
							            echo "font-size:11px; font-weight:bolder;";
							            echo "color:#a6a6a6;";
							        }
						        ?>"  
						            href="notification.php?id=<?php echo $i["notif_id"]; ?>">
						            <?php echo $i["name"]; ?>
						            <br>
						                <?php echo $i["message"]; ?>
						            		</a>
						        	</span>

						            <div class="dropdown-divider"></div>
						        <?php
		                			}
		                		?>
		                			<a href="notification.php?del=<?php echo $SESSION; ?>">Clear all notifications</a>
		                		<?php
		                			}	
		                		?>
						        </li>
						    </ul>
				      	</li>

						<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
						<?php
							$sql2 = "SELECT name FROM images WHERE user_id='$SESSION' ORDER BY id DESC LIMIT 1";
							$result2 = mysqli_query($conn,$sql2);
							$row2 = mysqli_fetch_array($result2);
							$image = $row2['name'];
							$image_src = "img/profile/".$image;	
						?>						
						<li style="border:2px solid grey; border-radius:40px;" class="menu-has-children" style=""><a style="color:black; cursor:pointer;">
						<?php 
							if(mysqli_num_rows($result2)==0)
							{
						?>
							<img src="img/user3.png" alt="user"></a>
						<?php 
							}
							else
							{
						?>
							<img width="32" height="32" style="border-radius:32px;" src="<?php echo $image_src; ?>" alt="user"></a> 
						<?php 
							}
						?>
							<ul style="border-radius:10px;">
								<li ><a style="border-radius:5px;" href="?log=1" class="ticker-btn" href="#">Logout</a></li>
							</ul>
						</li>
						<?php 
							$select="SELECT user_first FROM user WHERE user_id='$SESSION'";
							$res= mysqli_query($conn,$select);
							$disp=mysqli_fetch_assoc($res);
						?>
						<li style="font-size:14px; margin-top:10px;">Welcome, <?php echo $disp["user_first"]; ?></li>
							
						<?php 
				                if(isset($_GET['log']))
				                {                        
				                    if($_GET['log']=='1')
				                    {
				                        session_unset();
				                        session_destroy();
				                        echo ' <script type="text/javascript">';
										echo 'window.location.href="index.php" ';
										echo '</script>';
				                        exit();
				                    }
				                }
	                		}

                			else if (isset($_SESSION['r_id'])) 
                			{
                				$SESSION=$_SESSION['r_id'];
                				$fetch="SELECT recruiter_first FROM recruiter WHERE account_status='Verified' AND recruiter_id='$SESSION'";
                				$res= mysqli_query($conn,$fetch);
                		?>
                				<li><a href="about_us.php">About Us</a></li>
                				<li><a href="price.php">Price</a></li> 
	                			<li><a href="recruiter/recprof.php">Personal Details</a></li>


	                	<?php  
	                			if(mysqli_num_rows($res)==0)
	                			{
	                				echo '';
	                			}
	                			else 
	                			{
	                	?>

		                        <li><a href="recruiter/recjob.php">Job Details</a></li>
		                        <li class="menu-has-children">
						        	<a class="nav-link" href="#"><img src="img/notification.png" alt="notifications"> 
							            <?php
		                					$query = "SELECT COUNT(notif_id) as count_unread from notifications where receiver_id='$SESSION' and type='Job Application' and status = 'unread' order by `notif_date` DESC LIMIT 10";
		                					$result=mysqli_query($conn,$query);

		                					if(mysqli_num_rows($result)>0)
		                					{
		                						while($row=mysqli_fetch_array($result))
		                						{
		                					
		                				?>
				                				<span class="badge badge-light"><?php echo $row['count_unread']?></span>
							            <?php
							            		}
							                }
							            ?>
	              					</a>
						             
						        	<ul>
						        		<li>
								            <?php
								            	
			                					$query2 = "SELECT * from notifications where receiver_id='$SESSION' and type='Job Application' order by `notif_date` DESC LIMIT 10";
			                					$result2=mysqli_query($conn,$query2);

			                					if(mysqli_num_rows($result2)==0)
		                						{
		                					?>
		                						<span style="font-size:14px;">You have no notifications present as of now.</span>
		                					<?php
		                						}
		                						else
		                						{
			                						while($i=mysqli_fetch_array($result2))
			                						{

			                				?>
			                						<span id="notifbar" style ="cursor:pointer;" class="" >
							                         	<a style="						                         
								                         	<?php
									                            if($i['status']=='unread')
									                            {
									                                echo "font-size:11px; font-weight:bolder;";
									                            }
									                            else
									                            {
									                            	echo "font-size:11px; font-weight:bolder;";
									                            	echo "color:#a6a6a6;";
									                            }
								                         	?>"  
							                         	href="notification.php?rid=<?php echo $i["notif_id"]; ?>">
							                         		<?php echo $i["name"]; ?>
							                         		<br>
							                         		<?php echo $i["message"]; ?>
							                         	</a>
							                     	</span>

							                     	<div class="dropdown-divider"></div>
							                <?php

							                			}
							                ?>
							                		<br>
							                		<a href="notification.php?del=<?php echo $SESSION; ?>">Clear all notifications</a>
							                <?php
			                					}	
			                					
			                				?>
			                				
							          	</li>
							        </ul>
				      			</li>
				      		<?php  
				      			}
				      		?>
							<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
							<?php
								$sql2 = "SELECT name FROM images WHERE recruiter_id='$SESSION' ORDER BY id DESC LIMIT 1";
								$result2 = mysqli_query($conn,$sql2);
								$row2 = mysqli_fetch_array($result2);

								$image = $row2['name'];
								$image_src = "img/profile/".$image;	
							?>						
							<li style="border:2px solid grey; border-radius:40px;" class="menu-has-children" style=""><a style="color:black; cursor:pointer;">
								<?php 
									if(mysqli_num_rows($result2)==0)
									{
								 ?>
								<img src="img/user3.png" alt="user"></a>
								<?php 
									}
									else
									{
								 ?>
								 	<img width="32" height="32" style="border-radius:32px;" src="<?php echo $image_src; ?>" alt="user"></a>
								 <?php 
								 	}
								  ?>
									<ul style="border-radius:10px;">
										<li ><a style="border-radius:5px;" href="?log=1" class="ticker-btn" href="#">Logout</a></li>
									</ul>
							</li>
				      			
						        
						<?php 

								if(isset($_GET['log']))
			                    {                        
			                        if($_GET['log']=='1')
			                        {
			                            session_unset();
			                            session_destroy();
			                            echo ' <script type="text/javascript">';
										echo 'window.location.href="index.php" ';
										echo '</script>';
			                            exit();

			                        }
			                    }
			                }

			            	else
                			{

						 ?>
						 	<li><a href="about_us.php">About Us</a></li>
						 	<li><a href="price.php">Pricing</a></li>
	                    	<li><a href="category.php">Category</a></li>
					       	<!--<li><a href="price.html">Price</a></li>-->
					        <li class="menu-has-children"><a style="color:black; cursor:pointer;">Recruiter&nbsp;</a>
								<ul>
									<li><a class="" data-toggle="modal" data-target="#modalSignupRec"  href="#"><b class="dark">Signup</b></a></li>
									<li><a data-toggle="modal" data-target="#modalLoginRec" class="" href="#"><b class="dark">Login</b></a></li>
				            	</ul>
				          	</li>

				          	<li class="menu-has-children"><a style="color:black; cursor:pointer;">Candidate&nbsp;</a>
								<ul>
									<li><a data-toggle="" data-target="" class="" href="signup.php"><b class="dark">Signup</b></a></li>
									<li><a data-toggle="modal" data-target="#modalLogin" class="" href="#"><b class="dark">Login</b></a></li>
				            	</ul>
				          	</li>
				    
                		<?php 

                			}

                		 ?>

				          				          				          
				        </ul>
				    </nav><!-- #nav-menu-container -->		    		
			   	</div>
			</div>
		</header><!-- #header -->
