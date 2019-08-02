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
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/nice-select.css">					
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/main.css">	

	<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c4aba6ac9830d001319adb6&product=sticky-share-buttons' async='async'></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript">

		$(document).ready(function(){
			$('.location-search input[type="text"]').on("keyup input", function(){
			   /* Get input value on change */
			    var inputVal = $(this).val();
			    var resultDropdown = $(this).siblings(".result");
			    if(inputVal.length){
			        $.get("location-search.php", {term: inputVal}).done(function(data){
			            // Display the returned data in browser
			            resultDropdown.html(data);
			        });
			    } else{
			        resultDropdown.empty();
			    }
			});
			    
			    // Set search input value on click of result item
			$(document).on("click", ".result p", function(){
			    $(this).parents(".location-search").find('input[type="text"]').val($(this).text());
			    $(this).parent(".result").empty();
			});
		});

	</script>
</head>

<body>

	<?php 
		include 'header.php';   
	?>

	<?php 
		if(!isset($_SESSION['r_id']))
		{
			$message='';

			include 'includes/dbh.inc.php';

			$sql="SELECT job_id FROM joblist";
			$result= mysqli_query($conn,$sql);

			$rowcount=mysqli_num_rows($result);

	?>
		<br>
		<section class="banner-area relative" id="home">	
			<div class="overlay overlay-bg"></div>
			<div class="container">	
				<div class="row fullscreen align-items-center justify-content-center">
					<div class="banner-content col-lg-12">
						<h1 class="text-white">
							<span><?php echo $rowcount+100; ?></span> Jobs posted last week				
						</h1><br><!--<p class="text-white"><span>Search by tags:</span> Technology, Business, Consulting, IT Company, Design, Development</p>--><br>
						<?php 
							if(isset($_GET['signup']))
							{
								$signup=$_GET['signup'];

								if($signup=='invalid_email')
								{
									$message='Email has already been taken. Use another email.';
								}
								else if($signup=='usertaken')
								{
									$message='Username has already been taken. Use another username.';
								}
								else if($signup=='invalid_mobileno')
								{
									$message='Mobile number should be exactly 10 digits and only contain numeric values.';
								}
								else
								{
								}
						?>
						<p class="text-white"><img src="img/w2.png"><b><b class="dark" style="color:white; "><?php echo $message; }?></b></b></p>

							<?php echo $message; ?>

						<form action="category.php" method="POST" class="serach-form-area">
							<div class="row justify-content-center form-wrap">
								<div class="col-lg-5 form-cols location-search">
									<input autocomplete="off" type="text" class="form-control" id="loc" name="location" placeholder="Enter Location">
									<p class="result"></p>
								</div>

								<div class="col-lg-5 form-cols">
									<input id="search" type="text" class="form-control" name="skills" placeholder="Enter skill">			
								</div>

								<div class="col-lg-2 form-cols">
									<button type="submit" name="search" class="btn btn-index">
									    <span class="lnr lnr-magnifier"></span> Search
									</button>
								</div>								
							</div>
						</form>	
					</div>		
				</div>
			</div>
		</section>
		<?php 
			include "includes/dbh.inc.php";

			$top='';
			$sql="SELECT job_id,recruiter.recruiter_id,job_title,company,skills,job_summary,location,salary FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT 0,5";
			$result = mysqli_query($conn,$sql);

			if(mysqli_num_rows($result)==0)
			{
				$top='margin-top:-10px;';
			}
			else if(mysqli_num_rows($result)==1)
			{
				$top='margin-top:-280px;';
			}
			else
			{
				$top='margin-top:-220px;';
			}
		?>
		<section style="<?php echo $top; ?>" class="popular-post-area pt-100">
			<div class="container">
				<div class="row align-items-center">
					<div class="active-popular-post-carusel">
					<?php
							
						while($row = mysqli_fetch_array($result))  
						{
							$jid=base64_encode($row["job_id"]);
			 		?>
						<div class="single-popular-post d-flex flex-row">
							<div class="thumb">
								<img class="mb-50 img-fluid" src="img/pnicon.png" alt="">	
							</div>
							<div class="details">
								<a href="viewjob.php?id=<?php echo $jid; ?>"><h4><?php echo $row["job_title"]; ?></h4></a>
								<h6><?php echo $row["company"]; ?></h6>
								<h6>Location: <?php echo $row["location"]; ?></h6>
								<p>
									<b class="dark">Skills: <?php echo $row["skills"]; ?></b>
								</p>						
							</div>
						</div>	
					<?php 
						}
					?>																												
					</div>
				</div>
			</div>	
		</section>

		<section class="post-area section-gap-featured">
			<div class="container">
				<div class="row d-flex justify-content-center">
						<div class="menu-content pb-3 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Featured Job Categories</h1>
							</div>
						</div>
				</div>

				<div class="row" id="job_list">
					<div class="col-lg-2 col-md-4 col-sm-6">
						<a href="category.php?cat=111">
							<div class="single-fcat">
								<img src="img/o1.png" alt="">
								<p>Technology</p>
							</div>
						</a>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<a href="category.php?cat=112">
							<div class="single-fcat">
									<img src="img/o2.png" alt="">
								<p>Finance</p>
							</div>
							</a>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<a href="category.php?cat=113">
							<div class="single-fcat">
									<img src="img/o3.png" alt="">
								<p>Government</p>
							</div>
							</a>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<a href="category.php?cat=114">
							<div class="single-fcat">
								
									<img src="img/o4.png" alt="">
								
								<p>Medical</p>
							</div>
							</a>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<a href="category.php?cat=115">
							<div class="single-fcat">
								
									<img src="img/o5.png" alt="">
								
								<p>Media</p>
							</div>
							</a>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<a href="category.php?cat=117">
							<div class="single-fcat">
								
									<img src="img/o6.png" alt="">
								
								<p>Sales & Retail</p>
							</div>
							</a>	
						</div>																											
					</div><br><br>
					
					<div class="row justify-content-center d-flex">
						<div class="col-lg-8 post-list">			
						<?php 		
							include "includes/dbh.inc.php";
							include "pagination.php";

							$sql="SELECT job_id,recruiter.recruiter_id,job_title,job_type,company,skills,job_summary,location,salary FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,5";
							$result = mysqli_query($conn,$sql);
				
							while($row = mysqli_fetch_array($result))  
							{
								$id=base64_encode($row["recruiter_id"]);
								$jid=base64_encode($row["job_id"]);
								echo '							
									<div class="single-post d-flex">
										<div class="thumb">
											<img src="img/pnicon.png" alt="">
												<ul align="center" class="tags">
													<li style="background-color:#007bff; border:1px solid black;">
														<a href=\'viewjob.php?id='.$jid.'\' name="view" method="POST"><b><b class="light">View</b></b></a>
													</li><br>
													<li style="border:1px solid black;">
														<a href=\'savejob.php?jid='.$jid.'&rid='.$id.'\' name="savejob" method="POST"><b><b class="dark">Save</b></b></a>
													</li>	
										</div>

										<div style="margin-left:7%;" class="details">
											<div class="title d-flex flex-row justify-content-between">
												<div class="titles">											
													<a href=\'viewjob.php?id='.$jid.'\' name="view" method="POST"><h4>'.$row["job_title"].'</h4></a>
														<h6>'.$row["company"].'</h6>					
												</div>
											</div>

											<h5>Job Nature: '.$row["job_type"].'</h5>
												<p class="address"><img src="img/loc.png">: '.$row["location"].'</p>
												<p class="address"><img src="img/rupee.png">: '.$row["salary"].' P.A</p>
										</div>
									</div>';
							}
													
						?>
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

					

						<div class="single-slidebar">
							<h4>Jobs by Category</h4>
								<ul class="cat-list">
									<li><a class="justify-content-between d-flex" href="category.php?cat=111"><p>Information Technology</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.php?cat=112"><p>Finance</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.php?cat=113"><p>Government</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.php?cat=114"><p>Medical</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.php?cat=115"><p>Media</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.php?cat=116"><p>Accounting</p></a></li>
									<li><a class="justify-content-between d-flex" href="category.php?cat=117"><p>Sales & Retail</p></a></li>
								</ul>
						</div>	
					</div>		

				<?php 
					$res=mysqli_query($conn,"SELECT job_id,recruiter.recruiter_id,job_title,job_type,company,skills,job_summary,location,salary FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE account_status='Verified' AND job_status='active' ORDER BY job_id DESC");
					$count=mysqli_num_rows($res);
					$ceil=ceil($count/5);

					$middle = (($page+4>$ceil)?$ceil-4:(($page-4<1)?5:$page));
					$pglink='';
				?>

				<nav align="center" aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
					<?php
						if($page>=2)
						{
							echo '<li class="page-item"><a class="page-link" href="?pg=1#job_list">First Page</a></li>'; 
							echo '<li class="page-item"><a class="page-link" href="?pg='.($page-1).'#job_list">Previous</a></li>';
						}
						if($ceil<9)
						{
							for($i=1;$i<=$ceil;$i++)
							{
								if($i=='')
								{
								    if($i==1)
								    {
								        echo '<li class="page-item active"><a class="page-link" href="?pg='.$i.'#job_list">'.$i.'</a></li>';
								    }
								    else
								    {
								        echo '<li class="page-item"><a class="page-link" href="?pg='.$i.'#job_list">'.$i.'</a></li>';
								    }
								}
								else if($page==$i)
								{
								    echo '<li class="page-item active"><a class="page-link" href="?pg='.$i.'#job_list">'.$i.'</a></li>';
								}
								else
								{
								    echo '<li class="page-item"><a class="page-link" href="?pg='.$i.'#job_list">'.$i.'</a></li>';
								}
							}
						}
						else
						{
							for($i=-4;$i<=4;$i++)
							{
								if($middle+$i==$page)
									$pglink .='<li class="page-item active"><a class="page-link" href="?pg='.($middle+$i).'#job_list">'.($middle+$i).'</a></li>';
								else
									$pglink .='<li class="page-item"><a class="page-link" href="?pg='.($middle+$i).'#job_list">'.($middle+$i).'</a></li>';
							}
								echo $pglink;
						}

						if($page<$ceil)
						{
							echo '<li class="page-item"><a class="page-link" href="?pg='.($page+1).'#job_list">Next</a></li>'; 
							echo '<li class="page-item"><a class="page-link" href="?pg='.$ceil.'#job_list">Last Page</a></li>';
						}   			    
		      		?>  
	      			</ul>
	      		</nav> 					
			</div>
		</section>
			<!-- End post Area -->
<?php   }
		else
		{
?>
	 	<section class="banner-area relative" id="home">	
			<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-center">
						<div class="banner-content col-lg-12">
							<h1 class="text-white">
								<?php 
									if(isset($_SESSION['r_id']))
									{
										$SESSION=$_SESSION['r_id'];
										$sql="SELECT recruiter_first,recruiter_last,account_status FROM recruiter WHERE recruiter_id='$SESSION'";
										$result=mysqli_query($conn,$sql);
										$row=mysqli_fetch_array($result);
										echo 'Welcome '.$row["recruiter_first"].' '.$row["recruiter_last"].'<br>';

										if($row["account_status"]=='Confirmed')
										{
											echo '<div class="mt-3"><h2 class="text-white">Your account is yet to be verified. You will not be able to post a job until your account is verified by the administrator.</h2></div>';
										}

									}
									
								 ?>	
							</h1>
						</div>	
					</div>
				</div>
		</section>
<?php 
		}

		if(isset($_SESSION['u_id']) || isset($_SESSION['r_id']))
		{

?>
		<section></section>
<?php 

		}
		else
		{
?> 
		<section class="callto-action-area section-gap section-gap-joinus" id="join">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="menu-content col-lg-9">
						<div class="title text-center">
							<h1 class="mb-10 text-white">Join us today without any hesitation</h1>
							<p class="text-white"></p>
							<a class="primary-btn" href="signup.php">I am a Candidate</a>
							<a data-toggle="modal" data-target="#modalSignupRec" class="primary-btn" href="#">I am a Recruiter</a>
						</div>
					</div>
				</div>	
			</div>
		</section>
<?php 

		}
?>

<?php
include 'footer.php';
?>