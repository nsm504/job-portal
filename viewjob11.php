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
			
<section class="post-area">
	<div class="container">
		<div class="row justify-content-center d-flex">
			<div class="col-lg-8 post-list">
			<?php 

				include "includes/dbh.inc.php";

				$id=base64_decode($_GET['id']);
				$title=isset($_GET['title']);
				$loc = isset($_GET['loc']);
									
				$sql=" SELECT job_id,job_title,company,location,job_type,skills,salary,no_hires,job_summary,description1,description2,description3,email FROM joblist WHERE job_id='$id' ";
				$result = mysqli_query($conn,$sql);

				while($row = mysqli_fetch_array($result)) 
				{ 
					$id=	 $row["job_id"];
					$title=  $row["job_title"];
					$cmp= $row["company"];
					$loc= 	 $row["location"];
					$type= $row["job_type"];
					$skills= $row["skills"];
					$sal= $row["salary"];
					$hires= $row["no_hires"];
					$jobsum= $row["job_summary"];
					$desc1= $row["description1"];
					$desc2= $row["description2"];
					$desc3= $row["description3"];
					$email= $row["email"];							
				}					
			?>
		 
				<div class="single-post d-flex flex-row">
					<div class="thumb">
						<img src="img/pnicon.png" alt="">
						<ul align="center" class="tags"></ul>
					</div>

					<div style="margin-left:2%;" class="details">
						<div class="title d-flex flex-row justify-content-between">
							<div class="titles">
								<a href="#"><h4><?php echo $title;?></h4></a>
								<h6><b class="dark"><?php echo $cmp;?></b></h6>					
							</div>	
						</div>
										
						<h5><b class="dark">Job Nature:</b>  <?php echo $type;?></h5>
						<h5><b class="dark">Skills:</b>  <?php echo $skills;?></h5>
						<p class="address"><img src="img/loc.png">: <?php echo $loc;?></p>
						<p class="address"><img src="img/rupee.png">: <?php echo $sal; ?> P.A</p>
					</div>
				</div>	

				<div class="single-post job-details">
					<h5><b class="dark">Job Nature:</b>    <?php echo $type;?></h5><br>
					<h5><b class="dark">Location:</b>     <?php echo $loc;?></h5><br>
					<h5><b class="dark">Salary:</b>    <?php echo $sal;?></h5><br>
					<h5><b class="dark">Skills:</b>     <?php echo $skills;?></h5><br>
					<h5><b class="dark">No of Openings:</b>    <?php echo $hires;?></h5><br>
					<h5><b class="dark">Job Summary:</b>     <?php echo $jobsum;?></h5><br>
					<h5><b class="dark">Responsibilities and Duties:</b>    <?php echo $desc1;?></h5><br>
					<h5><b class="dark">Required Experiences, Skills and Qualifications:</b><?php echo $desc2;?></h5><br>
					<h5><b class="dark">Benefits:</b>     <?php echo $desc3;?></h5>	
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
			<!-- End post Area -->
<?php
include 'footer.php';
?>