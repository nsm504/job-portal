	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="codepixer">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Proactive Jobs</title>
		<link rel="icon" type="image/png" href="img/picon.png">
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">					
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/main.css">
		</head>
		<body>

			<?php include 'header.php'; ?>

			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content-signup col-lg-12"><br>
							<h1 class="text-white">
								<br>
								Recruiter List	
							</h1>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	
				
			<!-- Start service Area -->
			<?php 

				include 'includes/dbh.inc.php';

				$sql="SELECT * FROM recruiter";
				$query=mysqli_query($conn,$sql);

			 ?>

			<section class="service-area mt-5 mb-160" id="service">
				<div class="container">
					<div class="row d-flex justify-content-center">

					</div>
					<div class="row">
						<?php 	
							while($row=mysqli_fetch_array($query))
							{
 					 	?>
						<div class="col-lg-4 col-md-6">
							<div class="single-service"	style="hover:none; border:2px solid grey;">
								<h3><span class="lnr lnr-user"> <?php echo $row["recruiter_first"].' '.$row["recruiter_last"]; ?></span></h3><br>
								<h4><span>Post: <?php echo $row["recruiter_designation"]; ?></span></h4><br>
								<h5><span>Company: <?php echo $row["company_name"]; ?></span></h5>
							</div>
						</div>
						<?php } ?>
					</div>

				</div>	
			</section>

<?php
include 'footer.php';?>