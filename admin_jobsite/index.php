<?php
session_start();

	if(!isset($_SESSION['job_admin']))
	{
		echo '<script type="text/javascript">';
		echo 'window.location.href="login.php"';
		echo '</script>';		
	} 
	else
	{	
		include 'header.php';
		include 'nav.php';
		include '../includes/dbh.inc.php'; 

		include 'functions.php';
?>

	<body>
		<div class="mt-3" align="center">
			<h2>ADMIN HOME PAGE</h2>
		</div>		
		<div class="mt-40">
			<div class="container">
				<div align="center">
			        <div class="row">
			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b><b>Total Candidates Registered</b></b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo countCandidate($conn); ?></h1></a>
			                    </div>
			               	</div>
			            </div>   

			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b>Verified Candidates</b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo countVerifiedCandidate($conn); ?></h1></a>
			                    </div>
			                </div>
			            </div>    

			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b>Graduates</b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo countGraduates($conn); ?></h1></a>
			                    </div>
			                </div>
			            </div>

			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b>Most Popular Qualification</b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo mostPopularQualification($conn); ?></h1></a>
			                    </div>
			                </div>
			            </div>               
			        </div> <br>


			        <div class="row">
			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b><b>Total Recruiters Registered</b></b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo countRecruiter($conn); ?></h1></a>
			                    </div>
			               	</div>
			            </div>   

			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b>Verified Recruiters</b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo countVerifiedRecruiter($conn); ?></h1></a>
			                    </div>
			                </div>
			            </div>    

			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b>Most Popular Industry</b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo mostPopularIndustry($conn); ?></h1></a>
			                    </div>
			                </div>
			            </div>

			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b>Most Popular Company</b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo mostPopularCompany($conn); ?></h1></a>
			                    </div>
			                </div>
			            </div>               
			        </div> <br>


			        <div class="row">
			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b><b>Total Jobs</b></b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo countJob($conn); ?></h1></a>
			                    </div>
			               	</div>
			            </div>   

			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b>Job With Highest Package</b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo mostPopularJobPosted($conn); ?></h1></a>
			                    </div>
			                </div>
			            </div>    

			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b>Job With Most Applications</b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo mostAppliedJob($conn); ?></h1></a>
			                    </div>
			                </div>
			            </div>

			            <div class="col-md-3">
			                <div class="box-container">
			                    <div class="text-center"><b>Company With Most Applications</b></div>
			                    <div class="data" align="center">
			                        <a class="" href=""><h1><?php echo mostAppliedCompany($conn); ?></h1></a>
			                    </div>
			                </div>
			            </div>               
			        </div> <br>

				</div>
			</div>
		</div>
	</body>
	<?php 

	   }
	 ?>
</html>
