<?php 
	include 'nav.php';
	include 'header.php';
	include '../includes/dbh.inc.php';

	if(!isset($_SESSION['u_id']))
	{
		echo '<script type="text/javascript">';
		echo 'window.location.href="../index.php"';
		echo '</script>';
	}
	else
	{
		$SESSION = $_SESSION['u_id'];

		$sql= "SELECT user_first,user_last FROM user where user_id='$SESSION'";
		$result = mysqli_query($conn,$sql);
							
		$sql2 = "SELECT name FROM images WHERE user_id='$SESSION' ORDER BY id DESC LIMIT 1";
		$result2 = mysqli_query($conn,$sql2);
		$row2 = mysqli_fetch_array($result2);

		$image = $row2['name'];
		$image_src = "../img/profile/".$image;

		$sql3= "SELECT name FROM user_docs WHERE user_id='$SESSION' AND document_type='resume'";
		$result3 = mysqli_query($conn,$sql3);
		$row3 = mysqli_fetch_array($result3);

		$resume = $row3['name'];
		$resume_src="../documents/candidate/resume/".$resume;
	}

	$_SESSION['userId']=$SESSION;
?>

<body>
<br><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3" style="margin-top:-50px;">

				<?php  
					echo '<div class="menu-content ">'; 						
						if($result->num_rows>0)
						{
							while($row=$result->fetch_assoc())
							{
								echo '<h3 style="color:white;" align="center" >Welcome'.' '.$row["user_first"].' '.$row["user_last"].'!</h3><br>' ; 

							}
						}

					echo '   <b><div class="text-center">
				        			<img style="background-image:url(../img/user.png); background-repeat:no-repeat; background-position:center; background-color:#cdcdcd;" src="'.$image_src.'"  class="avatar img-circle " ><br><br>
				        								
				       				<form method="POST" action="../imgupload.inc.php" enctype="multipart/form-data">
	  									&nbsp;<input type="file" name="file" class="filealign text-center center-block file-upload">
	  									<input type="submit" value="Upload" name="but_upload">
									</form>
		      					</div>';

		      		echo '</div>';
				?>   		

				<div>
					<div class="sidebar" style="width:100%;">
						<div class="single-slidebar">
							<h4>UPLOAD RESUME (.pdf,.docx,.rtf formats accepted)</h4>
							
							<a href="<?php echo $resume_src; ?>" target="_blank"><?php echo $resume; ?></a>
							<form method="POST" action="resupload.php" enctype="multipart/form-data">
	  							&nbsp;<input type="file" name="resume" class="filealign text-center center-block file-upload">
	  							<input type="submit" value="Upload" name="res_upload">
							</form>
							<br>
							<a href="userdocs.php" class=""><b class="dark docs-link">Upload important documents (Required for verification)</b></a>
						</div>
					</div>
				</div>

			</div>

			<div class=""><br>

				<div class="tab">
				    <button class="tablinks" onclick="openCity(event, 'Profile')" id="defaultOpen">Profile</button>
				  	<button class="tablinks" onclick="openCity(event, 'Details')">Educational Details</button>
				  	<button class="tablinks" onclick="openCity(event, 'Skills')">Skills</button>
				  	<button class="tablinks" onclick="openCity(event, 'Experience')">Work Experience</button>
				  	<button class="tablinks" onclick="openCity(event, 'applyjob')">Applied Jobs</button>
				  	<button class="tablinks" onclick="openCity(event, 'savejob')">Saved Jobs</button>
				</div>

				<div id="Profile" class="tabcontent">

				  	<div class="single-post">
						<form id="editUserProfile">
							<br>

							<b class="dark label ">First Name</b><input class="form-control inputsize inline-flex align" type="text" name="first" value="<?php include '../data/users/firstname.php';?>"> <br>
							
							<b class="dark label">Last Name</b>
							<input class="form-control inputsize inline-flex align"  type="text" name="last" value="<?php include '../data/users/lastname.php';?>"><br>

							<b class="dark label">Mobile Number</b>
							<input class="form-control inputsize inline-flex align"  type="text" name="mobile" value="<?php include '../data/users/mobile.php';?>"><br>

							<b class="dark label">Location</b>
							<input class="form-control inputsize inline-flex align"  type="text" name="loc" value="<?php include '../data/users/location.php';?>"><br>

							<b class="dark label">Email ID</b>
							<input class="form-control inputsize inline-flex align"  type="text" name="email" value="<?php include '../data/users/email.php';?>"><br>

							<b class="dark label">UserName</b>
							<input class="form-control inputsize inline-flex align"  type="text" name="uid" value="<?php include '../data/users/username.php';?>"><br>
							
							<b class="dark label">Date Of Birth</b>
							<input class="form-control inputsize inline-flex align"  type="date" name="dob" value="<?php include '../data/users/dob.php';?>"><br>
							
							<b class="dark label">Gender</b>
							<input class="form-control inputsize inline-flex align"  type="text" name="gender" value="<?php include '../data/users/gender.php';?>"><br><br>
								
							<button class="btn-success btn-align " type="submit" name="update">Update</button>
						</form>
					</div>

					<p class="profile"></p>
				</div>

				<div id="Skills" class="tabcontent">
					<div class="single-post">
						<div class=""><br>
							<a data-toggle="modal" data-target="#addSkills"  href="#"><h4 class="btn-align"><img src="../img/add2.png"> Add Skills</h4></a>
								<div class="modal fade" id="addSkills" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h3>Add Skills</h3>					  
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
						
						
											<div class="modal-body">
												<form id="formSkill">

													<div id="row" class="row">
														<div class="col-md-8 ml-50">
															<div class="form-group"><input type="text" class="form-control " id="skill" name="skill" placeholder="Enter Skill">
															</div>
														</div>

													</div>

													<div class="btn-align">
														<button class="btn-success" type="submit" name="addskill">Insert</button>
													</div>

												</form>
	
											</div>
					
										</div>				 
									</div>				
								</div>
						</div>
					</div>


					<table id="skills_table" class="table" align="center" width="50%">
						<thead>
							<tr id="">
								<th id="thh">Skills</th>								
							</tr>
						</thead>
							<?php 
								include '../includes/dbh.inc.php';

								if(isset($_SESSION['u_id']))
								{
					 				$SESSION = $_SESSION['u_id'];
									$sql="SELECT skills FROM details WHERE user_id='$SESSION'";
									$result=mysqli_query($conn,$sql);

									while($row=mysqli_fetch_array($result))
									{
										$skills=$row["skills"];

										$skill_arr=explode(',',$skills);

										foreach ($skill_arr as $value) 
										{

							 ?>
						
							<tr id="">
								<td id="thh"><?php echo $value; ?></td>
							</tr>
							
							<?php 	
										}
										
									}
								}
						 	?>	
					</table>
				</div>


				<div id="Details" class="tabcontent">
					<div class="single-post ">
						<div class="">
							<?php 
								include '../includes/dbh.inc.php';

								if(isset($_SESSION['u_id']))
								{
					 				$SESSION = $_SESSION['u_id'];
									$sql="SELECT * FROM details WHERE user_id='$SESSION'";
									$result=mysqli_query($conn,$sql);

									while($row=mysqli_fetch_array($result)) {
										$hq=$row["highest_qualification"];
										$pgcourse=$row["pg_course"];
										$course=$row["course"];
										$spec=$row["specialization"];
										$uni=$row["university"];
										$pyear=$row["passing_year"];
										$perc=$row["percentage"];
										$hperc=$row["hsc_percentage"];
										$hboard=$row["hsc_board"];
										$hyear=$row["hsc_year"];
										$sperc=$row["ssc_percentage"];
										$sboard=$row["ssc_board"];
										$syear=$row["ssc_year"];
									}
								}

							 ?>
							<form id="editUserDetails">
							<br>
								<div style="border-top:1px solid #ccc;">
								<br>
									<b class="dark label">Qualification</b>
									<select id="grad_option" class="form-control inputsize inline-flex align" type="text" name="hq"><option><?php echo $hq;?></option><option>Completed 12th</option><option>Graduate</option><option>Post-Graduate</option>
									</select><br><br>
								</div>

								<p hidden style="display:block;" id="pg"></p>

								<script type="text/javascript">
								
									$('#grad_option').change(function()
									{
										if($('#grad_option option:selected').text()=="Post-Graduate")
										{
											$('#pg').removeAttr('hidden');
											$('#pg_data').removeAttr('hidden');
										}
										else
										{
											$('#pg_data,#pg').attr('hidden','true');
										}
									});
								</script>

								<div id="pg_data" hidden style="border-top:1px solid #ccc;"><br>
									<b class="dark label">PG Course</b>
									<select id="pg_option" class="form-control inputsize inline-flex align" type="text" name="pgcourse">
										<option selected><?php echo $pgcourse; ?></option><option>CA</option><option>CS</option><option>DM</option><option>Integrated PG</option><option>LLM</option><option>MA</option><option>M.Arch</option><option>M.Ch</option><option>M.Com</option><option>M.Des</option><option>M.Ed</option><option>M.Pharma</option><option>MDS</option><option>MFA</option><option>MS</option><option>M.Sc</option><option>M.Tech</option><option>MBA</option><option>PGDM</option><option>MCA</option><option>Medical-MS/MD</option><option>PG Diploma</option><option>MVSC</option><option>MCM</option><option>Other</option>
									</select><br><br>
								</div>

								<div style="border-top:1px solid #ccc;">
								<br>
										
									<b class="dark label">Course</b>
									<select class="form-control inputsize" type="text" name="course"><option  selected><?php echo $course;?></option><option>B.E</option><option>B.tech</option><option>B.Sc</option><option>BCA</option><option>BA</option><option>B.Arch</option><option>B.Des</option><option>BP.Ed</option><option>BEL.Ed</option><option>BAMS</option><option>BUMS</option><option>BBA/BMS</option><option>BCom</option><option>B.Ed</option><option>BDS</option><option>BFA</option><option>BHM</option><option>B.Pharma</option><option>BHMS</option><option>LLB</option><option>MBBS</option><option>Diploma</option><option>BVSC</option><option>Others</option></select><br>
 
									<b class="dark label">Specialization</b>
									<input class="form-control inputsize inline-flex align"  style="text-align:left;" type="text" name="spec" value="<?php echo $spec;?>"><br>

									<b class="dark label">University</b>
									<input class="form-control inputsize inline-flex align"  style="text-align:left;" type="text" name="uni" value="<?php echo $uni;?>"><br>

									<b class="dark label">Year Of Passing</b>
									<input class="form-control inputsize inline-flex align"  style="text-align:left;" type="text" name="pyear" value="<?php echo $pyear;?>"><br>

									<b class="dark label">Percentage</b>
									<input class="form-control inputsize inline-flex align"  style="text-align:left;" type="text" name="perc" value="<?php echo $perc;?>"><br>
								</div><br>

								<div style="border-top:1px solid #ccc;">
									<br>
									<b class="dark label">HSC Board</b>
									<input class="form-control inputsize inline-flex align"  style="text-align:left;" type="text" name="hboard" value="<?php echo $hboard;?>"><br>

									<b class="dark label">Year of Passing</b>
									<input class="form-control inputsize inline-flex align"  style="text-align:left;" type="text" name="hyear" value="<?php echo $hyear;?>"><br>

									<b class="dark label">12th Percentage</b>
									<input class="form-control inputsize inline-flex align"  style="text-align:left;" type="text" name="hperc" value="<?php echo $hperc;?>"><br>
								</div><br>

								<div style="border-top:1px solid #ccc;">
									<br>
									<b class="dark label">SSC Board</b>
									<input class="form-control inputsize inline-flex align"  style="text-align:left;" type="text" name="sboard" value="<?php echo $sboard;?>"><br>

									<b class="dark label">Year of Passing</b>
									<input class="form-control inputsize inline-flex align"  style="text-align:left;" type="text" name="syear" value="<?php echo $syear;?>"><br>

									<b class="dark label">10th Percentage</b>
									<input class="form-control inputsize inline-flex align"  style="text-align:left;" type="text" name="sperc" value="<?php echo $sperc;?>"><br>
								</div><br>

								<div>
									<button class="btn-success btn-align " type="submit" name="updatedetails">Update</button>
								</div>

							</form>
							<p class="userdetails"></p>
						</div>
					</div>				
				</div>

				<div id="Experience" class="tabcontent">

				 	<div class="single-post ">
				 		<div class=""><br>
							<a data-toggle="modal" data-target="#modalAddJob"  href="#"><h4 class="btn-align "><img src="../img/add2.png">&nbsp;Add Experience</h4><br><br></a>

							<div class="modal fade" id="modalAddJob" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header"><h3>Experience</h3>
					  
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										
										</div>

										<div class="modal-body">
											<form id="formExperience">
												<div class="col-md-12">
													<div class="form-group">											  
														<input type="text" class="form-control" id="appointment_time" name="jd" placeholder="Job Designation">
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">											  
														<input type="text" class="form-control" id="appointment_time" name="cmp" placeholder="Company">
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-group">
														<select class="form-control inputsize inline-flex align" name="dur"><option>Duration</option><option>&lt; 6 months</option><option>6-12 months</option><option>1-2 years</option><option>2-5 years</option><option>&gt; 5 years</option></select>
													</div>
												</div>

												<div class="btn-align">
													<button class="btn-success" type="submit" name="insertexp">Insert</button>
												</div>
											</form>	
										</div>
									</div>
								</div>
							</div>
						</div>

						<table id="exp_table" class="table" align="center">
							<thead>
								<tr id="trr">
									<th id="thh">Job Designation</th>
									<th id="thh">Company</th>
									<th id="thh">Duration</th>
								</tr>
							</thead>

							<tbody>
							<?php 
								if(isset($_SESSION["u_id"]))
								{
									$id=isset($_GET['id']);
									$SESSION=$_SESSION["u_id"];
															
									include "../includes/dbh.inc.php";

									$sql="SELECT exp_id,job_designation,company,duration FROM experience WHERE user_id='$SESSION' ";
									$result = mysqli_query($conn,$sql);

									while($row = mysqli_fetch_array($result)) 
									{ 
										$id=base64_encode($row["exp_id"]);
																		
										echo "<tr id='trr'>";
										echo "<td id='tdd'>".$row["job_designation"]."</td>";
										echo "<td id='tdd'>".$row["company"]."</td>";
										echo "<td id='tdd'>".$row["duration"]."</td>";
																		
										echo "</tr>";	                                    
									}
								}
							?>
							</tbody>
						</table>
					</div>
				</div>


				<div id="applyjob" class="tabcontent">
					<div class="single-post"><br>
						<h3 align="center">Applied Jobs</h3><br>
						<table class="table" align="center">
							<thead>
								<tr id="trr">
									<th id="thh">Applied For</th>
									<th id="thh">Company</th>
									<th id="thh">Location</th>
									<th id="thh">Job Type</th>
									<th id="thh">Salary</th>
									<th id="thh">Status</th>
									<th id="thh">View</th>
								</tr>
							</thead>

							<tbody>
							<?php
								if(isset($_SESSION["u_id"]))
								{
									$SESSION=$_SESSION["u_id"];
														
									include "../includes/dbh.inc.php";

									$sql="SELECT applications.job_id,job_title,company,location,job_type,salary,status FROM applications INNER JOIN joblist ON applications.job_id=joblist.job_id WHERE user_id='$SESSION' ";
									$result = mysqli_query($conn,$sql);
														
									while($row = mysqli_fetch_array($result)) 
									{
										$jid=base64_encode($row["job_id"]);
																	
										echo "<tr id='trr'>";
										echo "<td id='tdd'>".$row["job_title"]."</td>";
										echo "<td id='tdd'>".$row["company"]."</td>";
										echo "<td id='tdd'>".$row["location"]."</td>";
										echo "<td id='tdd'>".$row["job_type"]."</td>";
										echo "<td id='tdd'>".$row["salary"]."</td>";
										echo "<td id='tdd'>".$row["status"]."</td>";
										echo "<td id='tdd'><a href='../viewjob11.php?id=$jid'><img src='../img/eye1.png'></a></td>";
										echo "</tr>";										
									}
								}
							?>
							</tbody>
						</table>
					</div>	
				</div>	


				<div id="savejob" class="tabcontent">
					<div class="single-post"><br>
						<h3 align="center">Saved Jobs</h3><br>
							<table class="table" align="center">
								<thead>
									<tr id="trr">
										<th id="thh">Saved Job</th>
										<th id="thh">Company</th>
										<th id="thh">Location</th>
										<th id="thh">Job Type</th>
										<th id="thh">Salary</th>
										<th id="thh">View</th>
									</tr>
								</thead>

								<tbody>
								<?php
									if(isset($_SESSION["u_id"]))
									{
										$SESSION=$_SESSION["u_id"];

										include "../includes/dbh.inc.php";

										$sql="SELECT saved_jobs.job_id,joblist.job_title,joblist.company,joblist.location,joblist.job_type,joblist.salary,joblist.email FROM joblist INNER JOIN saved_jobs ON joblist.job_id=saved_jobs.job_id WHERE saved_jobs.user_id='$SESSION' ";
										$result = mysqli_query($conn,$sql);
														
										while($row = mysqli_fetch_array($result)) 
										{
											$jid=base64_encode($row["job_id"]);
																	
											echo "<tr id='trr'>";					
											echo "<td id='tdd'>".$row["job_title"]."</td>";
											echo "<td id='tdd'>".$row["company"]."</td>";
											echo "<td id='tdd'>".$row["location"]."</td>";
											echo "<td id='tdd'>".$row["job_type"]."</td>";
											echo "<td id='tdd'>".$row["salary"]."</td>";
											echo "<td id='tdd'><a href='../viewjob.php?id=$jid'><img src='../img/eye1.png'></a></td>";
											echo "</tr>";										
										}
									}
								?>
								</tbody>
							</table>
					</div>	
				</div>	
			</div>			
		</div>
	</div><!-- Start popular-post Area -->
			

	<!--<section style="margin-top:-90px;" class="popular-post-area pt-100">
		<div class="container">
			<div class="row align-items-center">
				<div class="active-popular-post-carusel">
				<?php 
					include "../includes/dbh.inc.php";

					$sql="SELECT job_id,recruiter_id,job_title,company,skills,job_summary,location,salary FROM joblist WHERE job_status='active'";
					$result = mysqli_query($conn,$sql);
							
					while($row = mysqli_fetch_array($result))  
					{
						$jid=base64_encode($row["job_id"]);
			 	?>
					<div class="single-popular-post d-flex flex-row">
						<div class="thumb">
							<img class="mb-50 img-fluid" src="img/pnicon.png" alt="">		
						</div>

						<div class="details">
							<a href="#"><h4><?php echo $row["job_title"]; ?></h4></a>
							<h6><?php echo $row["company"]; ?></h6>
							<h6>Location: <?php echo $row["location"]; ?></h6>
							<p>
								<b class="dark">Skills: <?php echo $row["skills"]; ?></b>
							</p>	
						</div>

						<a style="margin-left:440px;" class=" btns text-uppercase" href="../viewjob.php?id=<?php echo $jid; ?>" name="view" method="POST"><b><b class="light">View</b></b></a>
					</div>	

				<?php 
					}
				?>																												
				</div>
			</div>
		</div>	
	</section><br><br>-->

<script>
	function openCity(evt, cityName) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");

		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			 tablinks[i].className = tablinks[i].className.replace("active", "");
		}
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";
	}

	document.getElementById('defaultOpen').click();
</script>
	

<?php
include 'footer.php';
?>

<script src="../js/editUserProfile.js"></script>
<script src="../js/editUserDetails.js"></script>
<script src="../js/addSkill.js"></script>
<script src="../js/addExperience.js"></script>