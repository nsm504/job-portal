<?php 

include 'nav.php';
include 'header.php';
include 'includes/dbh.inc.php';
	
	 ?>

<body>
	<section class="banner-area relative" id="home">	
		<div class="overlay overlay-bg"></div>
			<div class="d-flex align-items-center justify-content-center">
				<div class="about-content-signup col-lg-12"><br>
					<h1 class="text-white">
						<br>
						View Job Profile	
					</h1>
				</div>											
			</div>			
	</section><br>

			
	<!-- End banner Area -->	
	<?php 
		if(isset($_GET['job']))
		{
		 	$job=$_GET['job'];

		 	if($job=='signin')
		 	{
		 		$message='<p style=" " class="text-center"><b><b class="dark" style="color:red; "><img src="img/w2.png"> Please LOGIN before applying for a job.</b><b></p>';
		 	}
		 	else if($job=='applied')
		 	{
		 		$message='<p class="text-center"><b><b class="dark" style="color:green; ">Successfully applied for Job.</b></b></p>';
		 	}
		 	else if($job=='notsaved')
		 	{
		 		$message='<p style=" " class="text-center"><b><b class="dark" style="color:green; "><img src="img/w2.png">Please LOGIN before saving a job.</b></b></p>';
		 	}
		 	else if($job=='savedone')
		 	{
		 		$message='<p class="text-center"><b><b class="dark" style="color:green; ">Job has been saved in your profile.</b></b></p>';
		 	}
		 	else if($job=='res')
		 	{
		 		$message='<p style=" " class="text-center"><b><b class="dark" style="color:red; "><img src="img/w2.png"> You cannot apply for a job unless your account has been verified by the administrator.</b></b></p>';
		 	}
		 	else if($job=='rpt')
		 	{
		 		$message='<p style=" " class="text-center"><b><b class="dark" style="color:red; "><img src="img/w2.png"> You cannot apply for the same job more than once.</b></b></p>';
		 	}		 				

	?>

	<?php echo $message;  }?>
				
			<!-- Start post Area -->
	<section class="post-area">
		<div class="container">
			<div class="row justify-content-center d-flex">
				<div class="col-lg-8 post-list">
				<?php 

					include "includes/dbh.inc.php";

					$id=base64_decode($_GET['id']);
					$message='';
					
					$sql=" SELECT job_id,recruiter_id,job_title,company,location,job_type,skills,salary,no_hires,job_summary,description1,description2,description3,email,last_date FROM joblist WHERE job_id='$id'
						";
					$result = mysqli_query($conn,$sql);

					while($row = mysqli_fetch_array($result)) 
					{ 

						$id=	$row["job_id"];
						$rec=	$row["recruiter_id"];
						$title= $row["job_title"];
						$cmp= 	$row["company"];
						$loc= 	$row["location"];
						$type= 	$row["job_type"];
						$skills=$row["skills"];
						$sal= $row["salary"];
						$hires= $row["no_hires"];
						$jobsum= $row["job_summary"];
						$desc1= $row["description1"];
						$desc2= $row["description2"];
						$desc3= $row["description3"];
						$email= $row["email"];
						$last_date= $row["last_date"];                 
					}
							
					$jid=base64_encode($id);
					$rid=base64_encode($rec);
				?>

		 	
					<div class="single-post d-flex flex-row">
						<div class="thumb">
							<img src="img/pnicon.png" alt="">
								<ul align="center" class="tags">
									<li style="background-color:#007bff; border:1px solid black;">
										<a href="applyjob.php?id='<?php echo $jid;?>'" name="applyjob" method="POST"><b><b class="light">Apply</b></b></a>	
									</li><br>

									<li style="border:1px solid black;">
										<a href="savejob.php?jid='<?php echo $jid; ?>'&rid='<?php echo $rid; ?>'" name="savejob" method="POST"><b><b class="dark">Save</b></b></a>
									</li>
								</ul>
						</div>

						<div style="margin-left:2%;" class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a href="#"><h4><?php echo $title;?></h4></a>
										<h6><b class="dark"><?php echo $cmp;?></b></h6>					
								</div>

								<div style="margin-left:2%;" class="sharethis-inline-share-buttons"></div>	
							</div>
									
							<h5><b class="dark">Job Nature:</b>  <?php echo $type;?></h5>
							<h5><b class="dark">Skills:</b>  <?php echo $skills;?></h5>
							<p class="address"><img src="img/loc.png">: <?php echo $loc;?></p>
							<p class="address"><img src="img/rupee.png">: <?php echo $sal; ?> P.A</p>
							<p class="address"><b><b class="dark">Apply by: </b></b><b class="dark"><?php echo $last_date; ?></b></p>	
						</div>
					</div>	

					<div class="single-post job-details">
						<h5><b class="dark">Job Nature:</b>   <?php echo $type;?></h5><br>
						<h5><b class="dark">Skills:</b>     <?php echo $skills;?></h5><br>
						<h5><b class="dark">No of Openings:</b>    <?php echo $hires;?></h5><br>
						<h5><b class="dark">Job Summary:</b><br>   <?php echo $jobsum;?></h5><br>
						<h5><b class="dark">Responsibilities and Duties:</b><br>    <?php echo $desc1;?></h5><br>
						<h5><b class="dark">Required Experiences, Skills and Qualifications:</b><br>     <?php echo $desc2;?></h5><br>
						<h5><b class="dark">Benefits:</b><br>     <?php echo $desc3;?></h5>
					</div>		

				</div>

				<div class="col-lg-4 sidebar">
					<div class="single-slidebar">
						<h4>Jobs by Location</h4>
						<ul class="cat-list">
							<li><a class="justify-content-between d-flex" href="category.php?city=1"><p>Mumbai</p></a></li>
							<li><a class="justify-content-between d-flex" href="category.php?city=2"><p>Delhi</p></a></li>
							<li><a class="justify-content-between d-flex" href="category.php?city=3"><p>Kolkata</p></a></li>
							<li><a class="justify-content-between d-flex" href="category.php?city=4"><p>Bengaluru</p></a></li>
							<li><a class="justify-content-between d-flex" href="category.php?city=5"><p>Hyderabad</p></a></li>
							<li><a class="justify-content-between d-flex" href="category.php?city=6"><p>Pune</p></a></li>
							<li><a class="justify-content-between d-flex" href="category.php?city=7"><p>Chennai</p></a></li>
							<li><a class="justify-content-between d-flex" href="category.php?city=8"><p>Gurugram</p></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>	
	</section>	

<?php
include 'footer.php';
?>