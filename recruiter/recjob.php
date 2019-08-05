<?php
	include 'nav.php'; 
	include 'header.php';
	include '../includes/dbh.inc.php';
	if(!isset($_SESSION['r_id']))
	{
		echo '<script type="text/javascript">';
		echo 'window.location.href="../index.php"';
		echo '</script>';
	}
	else
	{
		$SESSION = $_SESSION['r_id'];

		$sql= "SELECT recruiter_first,recruiter_last FROM recruiter where recruiter_id='$SESSION'";
		$result = mysqli_query($conn,$sql);

		$sql2 = "SELECT name FROM images WHERE recruiter_id='$SESSION' ORDER BY id DESC LIMIT 1";
		$result2 = mysqli_query($conn,$sql2);
		$row2 = mysqli_fetch_array($result2);

	}
?>

<body>
	<br><br><br>
	<div class="container-fluid">
		<div class="row"><br><br>
			<div class="col-lg-2 sidebar" style="margin-top:-50px;"><br><br><br>
				<div class="">

				</div>
			</div>

			<div class=""><br>
				<div class="tab">
					<button class="tablinks" onclick="openCity(event, 'Profile')" id="defaultOpen">Manage Jobs</button>
				</div>

				<div id="Profile" class="tabcontent">

					<div class="single-post ">
						<div class="">
						<br><a data-toggle="modal" data-target="#modalAddJob"  href="#"><h4 class="btn-align "><img src="../img/add2.png"> Add Job</h4><br><br></a>

						<div class="modal fade" id="modalAddJob" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header"><h3>Add Job</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

						<div class="modal-body">

							<form action="../includes/addjob.inc.php" method="POST">

								<div class="form-group">							
									<input type="text" class="form-control" id="appointment_email" name="title" placeholder="Job Title">
								</div>
																	
								<div class="row">

									<div class="col-md-12">
										<div class="form-group">							
											<input type="text" class="form-control" id="appointment_time" name="cmp" placeholder="Company">
										</div>
									</div>
																		
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="appointment_time" name="loc" placeholder="Location">
										</div>
									</div>
																		
									<div class="col-md-12">
										<div class="form-group">
											<select class="form-control" name="type">
												<option>Type of Job ?</option>
												<option>Full Time</option>
												<option>Part Time</option>
												<option>Temporary</option>
												<option>Contract</option>
												<option>Internship</option>
												<option>Commission</option>
												<option>Fresher</option>
												<option>Volunteer</option>
											</select> 
										</div>
									</div>
																		
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="appointment_time" name="skills" placeholder="Skills Required (eg. C, java)">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<select class="form-control" name="exp">
												<option>Enter work experience</option>
												<option>&lt; 6 months</option>
												<option>6-12 months</option>
												<option>1-2 years</option>
												<option>2-5 years</option>
												<option>&gt; 5 years</option>
											</select> 
										</div>
									</div>
																		
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="appointment_time" name="sal" placeholder="Salary ( Per year)">
										</div>
									</div>
																		
																		
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="appointment_time" name="hires" placeholder="No. of hires for this position">
										</div>
									</div>
																		
																		
									<div class="col-md-12">
										<div class="form-group">
											<textarea rows="7"  class="form-control" id="appointment_time" name="jobsum" placeholder="Job Summary                                                                                     ( Describe position and role within your company. )"></textarea>
										</div>
									</div>
															  
									<div class="col-md-12">
										<div class="form-group">
											<textarea rows="7"  class="form-control" id="appointment_time" name="desc1" placeholder="Responsibilities and Duties                                                                                 ( Outline the functions and person in this position will perform on regular basis. )"></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<textarea rows="7"  class="form-control" id="appointment_time" name="desc2" placeholder="Required Experiences, Skills and Qualifications                                                                                     ( This may include education, previous job experience, certifications and technical skills. )"></textarea>
										</div>
									</div>
															  
									<div class="col-md-12">
										<div class="form-group">
											<textarea rows="7"  class="form-control" id="appointment_time" name="desc3" placeholder="Benefits                                                                                              ( This may include training, mentoring, health insurance, commuting support, lunch service etc. )">
											</textarea>
										</div>
									</div>
															  
									<div class="col-md-12">
										<div class="form-group">

											<input type="text" class="form-control" id="appointment_time" name="email" placeholder="Email address">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">

											<b class="dark ml-5">Last date to apply:</b> <input type="date" class="date date-align form-control" id="datetimepicker1" name="last_date" placeholder="Last date to apply for job">
										</div>
									</div>																		
															  
									<div class="form-group">
										<input type="submit" name="submitjob" value="Post" class="btn btn-primary btn-outline-primary btn-align2">
									</div>
								</div>
							</form>
						</div>					
					</div>				 
				</div>
				
			</div>
		</div>

		<script type="text/javascript">
			$('#datetimepicker1').datetimepicker(
           	{
				format:'YYYY-MM-DD'
			}); 
		</script>

		<table class="table" align="center">
			<thead>
				<tr id="trr">
					<th id="thh">Job ID</th>
					<th id="thh">Job Title</th>
					<th id="thh">Posted On</th>
					<th id="thh">No.of applicants</th>
					<th id="thh">Status</th>																	
					<th id="thh">Action</th>			
				</tr>
			</thead>

			<tbody>	
			<?php 
																	
				if(isset($_SESSION["r_id"]))
				{
					$id=isset($_GET['id']);
					$jid=isset($_GET['id']);
					$SESSION=$_SESSION["r_id"];
																			
					include '../pagination.php';
					include "../includes/dbh.inc.php";

					$sql="SELECT job_id,job_title,time,job_status FROM joblist WHERE recruiter_id='$SESSION' ORDER BY job_id DESC LIMIT $page1,5";
					$result = mysqli_query($conn,$sql);

					while($row = mysqli_fetch_array($result)) 
					{ 
						$jid=$row["job_id"];
						$count="SELECT COUNT(app_id) AS app_count FROM applications WHERE job_id='$jid'";
						$output=mysqli_query($conn,$count);

						while($res=mysqli_fetch_array($output))
						{	
							$id=base64_encode($row["job_id"]);
																						
							echo "<tr id='trr'>";
							echo "<td id='tdd' name='jobid'>".$row["job_id"]."</td>";
							echo "<td id='tdd'>".$row["job_title"]."</td>";
							echo "<td id='tdd'>".$row["time"]."</td>";
							echo "<td id='tdd'><a id='view' href=\"recjob2.php?id=$id\" >".$res['app_count']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='../img/eye1.png'></a></td>";
							echo "<td id='tdd'>".$row['job_status']."</td>";
							echo "<td id='tdd'><a href=\"edit_job.php?id=$id\" ><img src='../img/edit.png'></a>";
							echo "</tr>";
						}															
					}
				}
			?>
			</tbody>
		</table>

		<?php 
			$res=mysqli_query($conn,"SELECT job_id,job_title,time FROM joblist WHERE recruiter_id='$SESSION' ORDER BY job_id DESC");
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
					echo '<li class="page-item"><a class="page-link" href="?pg=1">First Page</a></li>'; 
					echo '<li class="page-item"><a class="page-link" href="?pg='.($page-1).'">Previous</a></li>';
				}
				if($ceil<9)
				{
					for($i=1;$i<=$ceil;$i++)
					{
						if($i=='')
						{
							if($i==1)
							{
							    echo '<li class="page-item active"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
							}
							else
							{
							    echo '<li class="page-item"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
							}
						}
						else if($page==$i)
						{
							echo '<li class="page-item active"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
						}
						else
						{
							echo '<li class="page-item"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
						}
					}
				}
				else
				{
					for($i=-4;$i<=4;$i++)
					{
						if($middle+$i==$page)
							$pglink .='<li class="page-item active"><a class="page-link" href="?pg='.($middle+$i).'">'.($middle+$i).'</a></li>';
						else
							$pglink .='<li class="page-item"><a class="page-link" href="?pg='.($middle+$i).'">'.($middle+$i).'</a></li>';
					}
						echo $pglink;
				}
				if($page<$ceil)
				{
					echo '<li class="page-item"><a class="page-link" href="?pg='.($page+1).'">Next</a></li>'; 
					echo '<li class="page-item"><a class="page-link" href="?pg='.$ceil.'">Last Page</a></li>';
				}   
								    
	        ?>  
      		</ul>
      	</nav> 					
	</div>
</div>

<script>
	function openCity(evt, cityName) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");

		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}

		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";
	}
		document.getElementById('defaultOpen').click();
</script>

		</div>
	</div>
</div>
	
		</div>
	</div><br><br>			
<?php
include 'footer.php';?>
