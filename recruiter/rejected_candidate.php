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

	if(isset($_POST['app_id']) && isset($_POST['candidate_app']) && isset($_POST['int_date']))
	{
		$app=$_POST['app_id'];
		$int_date=$_POST['int_date'];
		$uid=$_POST['candidate_app'];

		$app_arr=explode(",",$app);
		$app_id=implode("','",$app_arr);

		$sql3="UPDATE applications SET interview_date='$int_date' WHERE app_id IN('$app_id')";
		$res=mysqli_query($conn,$sql3);
	}

	if(isset($_SESSION["r_id"]))
	{
		$rid=$_GET['id'];
		$id=base64_decode($_GET['id']);
		$SESSION=$_SESSION["r_id"];
?>

<body>
	<br><br><br><br>
	<div class="container-fluid">
		<div class="row"><br><br>

			<div class="">

				<div class="tab-link1">								  
					<a class="" href="recjob2.php?id=<?php echo $rid; ?>">Applied Candidates</a>
					<a class="" href="accepted_candidate.php?id=<?php echo $rid; ?>">Accepted Candidates</a>
					<a class="active">Rejected Candidates</a>
					<a class="" href="scheduled_interview.php?id=<?php echo $rid; ?>">Scheduled Interviews</a>
				</div>

				<div id="Rejected" class="tab-linkcontent1">

					<div class="row">
											
						<div class="col-lg-3 sidebar">
							<div class="single-slidebar">
								<h4>View Candidates by:</h4>
										
								<form action="#" method="POST">
												
									<div class="form-group">
										<label for="exampleFormControlSelect1"><b><b class="dark">Location</b></b></label>
										<select class="form-control" id="select_loc" name="loc">
											<option>Select location</option>
											<?php 
												$sql="SELECT DISTINCT location,user_first,user_last FROM applications INNER JOIN user ON applications.user_id=user.user_id WHERE user.location!='' AND status='rejected'";
												$query=mysqli_query($conn,$sql);

												while($result=mysqli_fetch_array($query)) 
												{
													echo '<option id="'.$result["user_first"].' '.$result["user_last"].'">'.$result["location"].'</option>';
												}
											?>
										</select>
									</div>
															
									<div class="form-group">
										<label for="exampleFormControlSelect1"><b><b class="dark">Percentage</b></b></label>
										<div class="col-xs-2 ml-25">
																			
										<input style="width:35%; border-radius: 2px !important;" type="text" class="form1" id="" name="perc_from" placeholder="From">
										<input style="width:35%; border-radius: 2px !important;" type="text" class="form1" id="" name="perc_to" placeholder="To">
									</div>
																	
									<div class="col-xs-2"></div>
																		
									<div class="col-xs-1"></div>


									<div class="form-group">
										<label for="exampleFormControlSelect1"><b><b class="dark">Date</b></b></label>
										<input type="date" class="form-control" id="from" name="date_from" placeholder="From"><br>
										<input type="date" class="form-control" id="to" name="date_to" placeholder="To">
									</div><br>

									<div align="center">
										<button type="submit" name="fetch">Search</button>
									</div>

								</form>
							</div>
						</div>

					</div>
											
					<div class="col-md-6">
					<?php 
							include '../pagination.php';
							$title="SELECT job_title FROM applications INNER JOIN joblist ON applications.job_id=joblist.job_id WHERE applications.recruiter_id='$SESSION' AND applications.job_id='$id' ";
							$fetch_title=mysqli_query($conn,$title);

							$title_row=mysqli_fetch_array($fetch_title);
					?>
						<h3 align="center">Rejected applicants for the post of <?php echo $title_row["job_title"]; ?></h3>
						<br>
						<table class="table" align="center">
							<thead>
								<tr id="trr">
									<th id="thh">Candidate Name</th>
									<th id="thh">Mobile No.</th>
									<th id="thh">Highest Qualification</th>
									<th id="thh">Course</th>
									<th id="thh">Percentage</th>
									<th id="thh">Resume</th>
									<th class="action-col" id="thh">Action&nbsp;&nbsp;&nbsp;&nbsp;</th>
								</tr>
							</thead>

							<tbody>
							<?php  
								if(isset($_POST['fetch']))
								{
									$loc=$_POST['loc'];
									$perc_from=$_POST['perc_from'];
									$perc_to=$_POST['perc_to'];
									$date_from=$_POST['date_from'];
									$date_to=$_POST['date_to'];

									if($loc!='Select location' && ($perc_from=='' && $perc_to==''))
									{
										$sql= "SELECT app_id,user.user_id,job_title,user_first,user_last,mobile,highest_qualification,course,specialization,percentage,interview_date FROM applications INNER JOIN user ON applications.user_id=user.user_id INNER JOIN joblist ON applications.job_id=joblist.job_id WHERE applications.recruiter_id='$SESSION' AND applications.job_id='$id' AND status='rejected' AND user.location='$loc' ORDER BY percentage DESC";
										$result= mysqli_query($conn,$sql);
									}
									else if(($perc_from!='' && $perc_to!='') && $loc=='Select location')
									{
										$sql= "SELECT app_id,user.user_id,job_title,user_first,user_last,mobile,highest_qualification,course,specialization,percentage,interview_date FROM applications INNER JOIN user ON applications.user_id=user.user_id INNER JOIN joblist ON applications.job_id=joblist.job_id WHERE applications.recruiter_id='$SESSION' AND applications.job_id='$id' AND status='rejected' AND (percentage BETWEEN '$perc_from' AND '$perc_to') ORDER BY percentage DESC";
											$result= mysqli_query($conn,$sql);
									}
									else if($loc!='Select location' && ($perc_from!='' && $perc_to!=''))
									{
										$sql= "SELECT app_id,user.user_id,job_title,user_first,user_last,mobile,highest_qualification,course,specialization,percentage,interview_date FROM applications INNER JOIN user ON applications.user_id=user.user_id INNER JOIN joblist ON applications.job_id=joblist.job_id WHERE applications.recruiter_id='$SESSION' AND applications.job_id='$id' AND status='rejected' AND (user.location='$loc' AND (percentage BETWEEN '$perc_from' AND '$perc_to')) ORDER BY percentage DESC";
										$result= mysqli_query($conn,$sql);
									}
									else
									{
										echo 'No records found !';
									}	
								}
								else
								{
									$sql="SELECT app_id,user.user_id,job_title,user_first,user_last,mobile,highest_qualification,course,specialization,percentage,interview_date FROM applications INNER JOIN user ON applications.user_id=user.user_id INNER JOIN joblist ON applications.job_id=joblist.job_id WHERE applications.recruiter_id='$SESSION' AND applications.job_id='$id' AND status='rejected' ORDER BY percentage DESC LIMIT $page1,5 ";
									$result = mysqli_query($conn,$sql);
								}

								while($row = mysqli_fetch_array($result)) 
								{ 
									$user_id=$row["user_id"];
									$sql2= "SELECT name FROM user_docs WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1 ";
									$result2 = mysqli_query($conn,$sql2);
									$row2 = mysqli_fetch_array($result2);

									$resume = $row2['name'];
									$resume_src="../documents/candidate/resume/".$resume;

									$uid=base64_encode($row["user_id"]);
									$app=$row["app_id"];
							?>
								<tr id='trr'>
									<td id='tdd' name='jobid'><?php echo $row["user_first"].' '.$row["user_last"]; ?>.</td>
									<td id='tdd'><?php echo $row["mobile"];?></td>
									<td id='tdd'><?php echo $row["highest_qualification"];?></td>
									<td id='tdd'><?php echo $row["course"].' '.$row["specialization"];?></td>
									<td id='tdd'><?php echo $row["percentage"];?></td>
									<td id='tdd'><a href="<?php echo $resume_src; ?>" target="_blank"><?php echo $resume; ?></a></td>
									<td id='tdd'><a name='accept' href="../del_app.php?app=<?php echo $app; ?>"><img src='../img/checked.png'></a>&nbsp;&nbsp;<a class='' href="../view_app.php?uid=<?php echo $uid;?>"><img src='../img/eye1.png'></a></td>
								</tr>
				<?php
								}
					}
				?>
							</tbody>
						</table>

							<?php 

						        $res=mysqli_query($conn,"SELECT * FROM applications WHERE recruiter_id='$SESSION' AND job_id='$id' AND status='rejected' ORDER BY percentage DESC");
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
							            echo '<li class="page-item bg-success"><a class="page-link" href="?id='.$rid.'&pg=1">First Page</a></li>'; 
							            echo '<li class="page-item bg-primary"><a class="page-link" href="?id='.$rid.'&pg='.($page-1).'">Previous</a></li>';
							          }

							          if($ceil<9)
							          {
							          	for($i=1;$i<=$ceil;$i++)
							          	{
							          		if($i=='')
							          		{
							          			if($i==1)
							          			{
							          				echo '<li class="page-item active"><a class="page-link" href="?id='.$rid.'&pg='.$i.'">'.$i.'</a></li>';
							          			}
							          			else
							          			{
							          				echo '<li class="page-item"><a class="page-link" href="?id='.$rid.'&pg='.$i.'">'.$i.'</a></li>';
							          			}
							          		}
							          		else if($page==$i)
							          		{
							          			echo '<li class="page-item active"><a class="page-link" href="?id='.$rid.'&pg='.$i.'">'.$i.'</a></li>';
							          		}
							          		else
							          		{
							          			echo '<li class="page-item"><a class="page-link" href="?id='.$rid.'&pg='.$i.'">'.$i.'</a></li>';
							          		}
							          	}
							          }
							          else
							          {
								        for($i=-4;$i<=4;$i++)
								        {
								            if($middle+$i==$page)
								              $pglink .='<li class="page-item active"><a class="page-link" href="?id='.$rid.'&pg='.($middle+$i).'">'.($middle+$i).'</a></li>';
								            else
								              $pglink .='<li class="page-item"><a class="page-link" href="?id='.$rid.'&pg='.($middle+$i).'">'.($middle+$i).'</a></li>';
								        }
								        	echo $pglink;
								      }
								        if($page<$ceil)
								        {
								            echo '<li class="page-item bg-success"><a class="page-link" href="?id='.$rid.'&pg='.($page+1).'">Next</a></li>'; 
								            echo '<li class="page-item bg-primary"><a class="page-link" href="?id='.$rid.'&pg='.$ceil.'">Last Page</a></li>';
								        }   
								    
	      							?>  
      							</ul>
      						</nav>
					</div>
				</div>

			</div>
		</div>
	</div>
	</div>
</div>
	
</div>
</div>			
<?php
include 'footer.php';?>
