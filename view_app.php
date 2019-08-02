<?php 

	include 'nav.php';
	include 'header.php';
	if(!isset($_SESSION['r_id']))
	{
		echo '<script type="text/javascript">';
		echo 'window.location.href="index.php"';
		echo '</script>';
	}
	else
	{
 ?>

<body>

	<section class="banner-area relative" id="home">	
		<div class="overlay overlay-bg"></div>		
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content-signup col-lg-12"><br>
					<h1 class="text-white">
					<br>
						View User Profile	
					</h1>
				</div>											
			</div>			
	</section><br>
			
			<!-- End banner Area -->	
					
			<!-- Start post Area -->
	<section class="post-area">
		<div class="container">
			<div class="row justify-content-center d-flex">
				<div class="col-lg-8 post-list">
				<?php 

					include "includes/dbh.inc.php";
					$id=base64_decode($_GET['uid']);
					
					$sql=" SELECT user_id,user_first,user_last,mobile,location,user_email,user_uid,dob FROM user WHERE user_id='$id' ";
					$result = mysqli_query($conn,$sql);

					$row = mysqli_fetch_array($result);
					 
					$uid=	 $row["user_id"];
					$user_first=	$row["user_first"];
					$user_last=  $row["user_last"];
					$mobile= $row["mobile"];
					$loc= 	 $row["location"];
					$email= $row["user_email"];
					$dob= $row["dob"];    

					$sql2="SELECT * FROM details WHERE user_id='$uid'";
					$result2=mysqli_query($conn,$sql2);
					$row2 = mysqli_fetch_array($result2);
									 
					$hq=$row2["highest_qualification"];
					$pgcourse=$row2["pg_course"];
					$course=$row2["course"];
					$spec=$row2["specialization"];
					$uni=$row2["university"];
					$skills=$row2["skills"];
					$pyear=$row2["passing_year"];
					$perc=$row2["percentage"];
					$hperc=$row2["hsc_percentage"];
					$hboard=$row2["hsc_board"];
					$hyear=$row2["hsc_year"];
					$sperc=$row2["ssc_percentage"];
					$sboard=$row2["ssc_board"];
					$syear=$row2["ssc_year"];                 
		 		?>
		 
					<div class="single-post d-flex flex-row">

						<div style="margin-left:2%;" class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a href="#"><h4><?php echo $user_first.' '.$user_last;?></h4></a>
								</div>			
							</div>
									
							<h5><b class="dark">Residence: <?php echo $loc; ?></b> </h5>
							<h5><b class="dark">Email: <?php echo $email; ?></b> </h5>
							<h5><b class="dark">Phone number: <?php echo $mobile; ?></b></h5>
							<h5><b class="dark">Date Of Birth: <?php echo $dob; ?></b> </h5>
						</div>
					</div>	

					<div class="single-post job-details">
						<h4 align="center">EDUCATIONAL DETAILS</h4><br>
						<h5><b class="dark">Highest Qualification: <?php echo $hq; ?></b></h5><br>
						<h5><b class="dark">Course: <?php echo $course; ?></b></h5><br>
						<h5><b class="dark">Specialization: <?php echo $spec; ?></b></h5><br>
						<h5><b class="dark">University: <?php echo $uni; ?></b></h5><br>
						<h5><b class="dark">Skills: <?php echo $skills; ?></b></h5><br>
						<h5><b class="dark">Undergraduate %: <?php echo $perc; ?></b></h5><br>
						<h5><b class="dark">Undergraduate Passing Year: <?php echo $pyear; ?></b></h5><br>
						<h5><b class="dark">HSC %: <?php echo $hperc; ?></b></h5><br>
						<h5><b class="dark">HSC Passing Year: <?php echo $hyear; ?></b></h5><br>
						<h5><b class="dark">SSC %: <?php echo $sperc; ?></b></h5><br>
						<h5><b class="dark">SSC Passing Year: <?php echo $syear; ?></b></h5><br>
					</div>	
										
				</div>
			</div>
		</div>	
	</section>
			
			<!-- End post Area -->


<?php
include 'footer.php';
}
?>