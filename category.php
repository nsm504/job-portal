<?php 

		include 'nav.php';
 ?>
	<body>

	<?php include 'header.php'; ?>

	<section class="banner-area relative" id="home">	
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="about-content-category col-lg-12">
					<h1 class="text-white">
						Job category				
					</h1>	
				</div>											
			</div>
		</div>
	</section>
			<!-- End banner Area -->	
			
			<!-- Start post Area -->
	<section class="post-area mt-5 mb-5">
		<div class="container">
			<div class="row justify-content-center d-flex">

				<div class="col-lg-8 post-list">

				<?php 		

					include "includes/dbh.inc.php";
					include "pagination.php";

					if(isset($_POST['search']))			/*Display job posting results on search */
					{
						$skills=$_POST['skills'];
						$location=$_POST['location'];

						if($skills!='' && $location=='')
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE skills LIKE '%$skills%' AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10 ";
						}
						else if($location!='' && empty($skills))
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,company,job_type,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE location LIKE '%$location%' AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10";
						}
						else if($skills!='' && $location!='')
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE (skills LIKE '%$skills%' AND location LIKE '%$location%' ) AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10";
						}
						else
						{
							echo '<b align="center" class="dark">No results found. Please enter some inputs before searching.</b>';
						}

					}

					else if(isset($_GET['city']))			/* Display job posting results by city */
					{
						$city=$_GET['city'];

						if($city==1)		/*Jobs in Mumbai */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE location LIKE '%Mumbai%' AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10";
						}
						else if($city==2)	/*Jobs in Delhi */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE location LIKE '%Delhi%' AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10";
						}
						else if($city==3)	/*Jobs in Kolkata */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE location LIKE '%Kolkata%' AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10";
						}
						else if($city==4)	/*Jobs in Bengaluru */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE location LIKE '%Bengaluru%' AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10";
						}
						else if($city==5)	/*Jobs in Hyderabad */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE location LIKE '%Hyderabad%' AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10";
						}
						else if($city==6)	/*Jobs in Pune */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE location LIKE '%Pune%' AND account_status='Verified' AND job_status='active'  ORDER BY job_id DESC LIMIT $page1,10";
						}
						else if($city==7)	/*Jobs in Chennai */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE location LIKE '%Chennai%' AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10";
						}
						else if($city==8)	/*Jobs in Gurugram */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE location LIKE '%Gurugram%' AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10";
						}
						else
						{
							echo '<script type="text/javascript">';
							echo 'window.location.href="index.php"';
							echo '</script>';
						}
					}
					else if(isset($_GET['cat']))		/*Display job posting results by category */
					{
						$category=$_GET['cat'];

						if($category==111)		/*Information Technology jobs */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE (job_title LIKE '%Developer%' OR job_title LIKE '%UI/UX Designer%' OR job_title LIKE '%Tester%' OR job_title LIKE '%Software%' OR job_title LIKE '%System%' OR job_title LIKE '%Data%') AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10";
						}
						else if($category==112)		/*Finance jobs */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE (job_title LIKE '%Finance%' OR job_title LIKE '%Accountant%' OR job_title LIKE '%Chartered%' OR job_title LIKE '%Actuarian%' OR job_title LIKE '%Business Analyst%' OR job_title LIKE '%Stock Analyst%') AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10 ";
						}
						else if($category==113)		/*Government jobs */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE (job_title LIKE '%Finance%' OR job_title LIKE '%Accountant%' OR job_title LIKE '%Chartered%' OR job_title LIKE '%Actuarian%' OR job_title LIKE '%Business Analyst%' OR job_title LIKE '%Stock Analyst%') AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10 ";
						}
						else if($category==114)		/*Medical jobs */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE (job_title LIKE '%Finance%' OR job_title LIKE '%Accountant%' OR job_title LIKE '%Chartered%' OR job_title LIKE '%Actuarian%' OR job_title LIKE '%Business Analyst%' OR job_title LIKE '%Stock Analyst%') AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10 ";	
						} 
						else if($category==115)		/*Media jobs */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE (job_title LIKE '%Media%' OR job_title LIKE '%Graphic Designer%' OR job_title LIKE '%Social Media%' OR job_title LIKE '%Digital Marketer%' OR job_title LIKE '%Content Writer%' OR job_title LIKE '%Reporter%') AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10 ";	
						}
						else if($category==116)		/*Accounting jobs */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE (job_title LIKE '%Accounting%' OR job_title LIKE '%Accountant%' OR job_title LIKE '%Business%' OR job_title LIKE '%Tax Consultant%' OR job_title LIKE '%Business Accountant%' OR job_title LIKE '%Chartered Accountant%') AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10 ";
						}		
						else if($category==117)		/*Sales and Retail Jobs */
						{
							$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE (job_title LIKE '%Sales%' OR job_title LIKE '%Retail%' OR job_title LIKE '%Marketing%' OR job_title LIKE '%Customer Service%' OR job_title LIKE '%Wholesale%') AND account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10 ";
						}
						else 		/*If user enters any other value in URL, redirect to home page*/
						{
							echo '<script type="text/javascript">';
							echo 'window.location.href="index.php"';
							echo '</script>';
						}
					}
					else
					{
						$sql="SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary,last_date FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT $page1,10";
					}

					$result = mysqli_query($conn,$sql);			

					if(mysqli_num_rows($result)==0)		/*If there are no results that can be displayed*/
					{
						echo '<b align="center" class="dark">No Jobs posted for this category as of now.</b>';
					}
					else
					{
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

				<!--	<div class="single-slidebar">
						<h4>Top rated job posts</h4>
						<div class="active-related job-carousel">
							<?php 
								include "includes/dbh.inc.php";

								$sql="SELECT * FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE  account_status='Verified' AND job_status='active' ORDER BY job_id DESC LIMIT 5";
								$result = mysqli_query($conn,$sql);
									
								while($row = mysqli_fetch_array($result))  
								{
									$jid=base64_encode($row["job_id"]);
					 		?>
							<div class="single-rated">
								<a href="single.html"><h4><?php echo $row["job_title"]; ?></h4></a>
								<h6><?php echo $row["company"]; ?></h6>

								<h5>Job Nature: <?php echo $row["job_type"]; ?></h5>
								<p class="address"><span class="lnr lnr-map">:</span> <?php echo $row["location"]; ?></p>
								<p class="address">₹: <?php echo $row["salary"] ?> P.A</p>
								<a href="viewjob.php?id=<?php echo $jid; ?>" class="btns text-uppercase">View job</a>
							</div>
						<?php 	} ?>																
						</div>-->
					</div>
				</div>

				<?php 

					$res=mysqli_query($conn,"SELECT job_id,joblist.recruiter_id,job_title,job_type,company,job_summary,location,salary FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE  account_status='Verified' AND job_status='active' ORDER BY job_id DESC");
					$count=mysqli_num_rows($res);
					$ceil=ceil($count/10);

					$middle = (($page+4>$ceil)?$ceil-4:(($page-4<1)?5:$page));
					$pglink = '';
				?>

				<nav align="center" aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
					<?php
						if($page>=2)
						{
							echo '<li class="page-item"><a class="page-link" href="?pg=1#home">First Page</a></li>'; 
							echo '<li class="page-item"><a class="page-link" href="?pg='.($page-1).'#home">Previous</a></li>';
						}
						if($ceil<9)
						{
							for($i=1;$i<=$ceil;$i++)
							{
							    if($i=='')
							    {
							        if($i==1)
							        {
							          	echo '<li class="page-item active"><a class="page-link" href="?pg='.$i.'#home">'.$i.'</a></li>';
							        }
							        else
							        {
							          	echo '<li class="page-item"><a class="page-link" href="?pg='.$i.'#home">'.$i.'</a></li>';
							        }
							    }
							    else if($page==$i)
							    {
							        echo '<li class="page-item active"><a class="page-link" href="?pg='.$i.'#home">'.$i.'</a></li>';
							    }
							    else
							    {
							        echo '<li class="page-item"><a class="page-link" href="?pg='.$i.'#home">'.$i.'</a></li>';
							    }
							}
						}
						else
						{
							for($i=-4;$i<=4;$i++)
							{
								if($middle+$i==$page)
								    $pglink .='<li class="page-item active"><a class="page-link" href="?pg='.($middle+$i).'#home">'.($middle+$i).'</a></li>';
								else
								    $pglink .='<li class="page-item"><a class="page-link" href="?pg='.($middle+$i).'#home">'.($middle+$i).'</a></li>';
							}
								echo $pglink;
						}
						if($page<$ceil)
						{
							echo '<li class="page-item"><a class="page-link" href="?pg='.($page+1).'#home">Next</a></li>'; 
							echo '<li class="page-item"><a class="page-link" href="?pg='.$ceil.'#home">Last Page</a></li>';
						}   
								    
	      			?>  
      				</ul>
      			</nav>	
      		</div>
      	</div>			
	</section>

<?php
	include 'footer.php';
?>
	