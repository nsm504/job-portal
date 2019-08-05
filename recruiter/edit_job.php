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

		$image = $row2['name'];
		$image_src = "../img/".$image;
	}
?>

<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content-signup col-lg-12">
					<h1 class="text-white">
					<br>
						Edit Job Profile	
					</h1>
				</div>											
			</div>
		</div>
</section>

<br><br>

<?php 

	$id=base64_decode($_GET['id']);
	$title=isset($_GET['title']);
	$loc = isset($_GET['loc']);
			
	$sql=" SELECT job_id,job_title,company,location,job_type,skills,experience,salary,no_hires,job_summary,description1,description2,description3,email,last_date FROM joblist WHERE job_id='$id' ";
	$result = mysqli_query($conn,$sql);

	while($row = mysqli_fetch_array($result)) 
	{ 

		$id=	 $row["job_id"];
		$title=  $row["job_title"];
		$cmp= $row["company"];
		$loc= 	 $row["location"];
		$type= $row["job_type"];
		$skills= $row["skills"];
		$exp= $row["experience"];
		$sal= $row["salary"];
		$hires= $row["no_hires"];
		$jobsum= $row["job_summary"];
		$desc1= $row["description1"];
		$desc2= $row["description2"];
		$desc3= $row["description3"];
		$email= $row["email"];
		$last_date= $row["last_date"];
					                                  
	}
		
?>

<div align="center" id="first">
	<form method="post" action="../includes/editjob.inc.php">

		<label class="dark label2"><b class="dark">Job Title:</b></label>
		<input class="form-control inputsize inline-flex align" type="text" name="title" value="<?php echo $title;?>"><br><br>
				
		<label class="dark label2"><b class="dark">Company:</b></label>
		<input class="form-control inputsize inline-flex align" type="text" name="cmp" value="<?php echo $cmp;?>"><br><br>

		<label class="dark label2"><b class="dark">Location:</b></label>
		<input class="form-control inputsize inline-flex align" type="text" name="loc" value="<?php echo $loc;?>"><br><br>

		<label class="dark label2"><b class="dark">Job Type:</b></label>
		<input class="form-control inputsize inline-flex align" type="text" name="type" value="<?php echo $type;?>"><br><br>
				
		<label class="dark label2"><b class="dark">Skills:</b></label>
		<input class="form-control inputsize inline-flex align" type="text" name="skills" value="<?php echo $skills;?>"><br><br>

		<label class="dark label2"><b class="dark">Experience Required:</b></label>
		<select class="form-control inputsize inline-flex align" name="exp">
			<option value=""><?php echo $exp; ?></option>
			<option>&lt; 6 months</option>
			<option>6-12 months</option>
			<option>1-2 years</option>
			<option>2-5 years</option>
			<option>&gt; 5 years</option>
		</select>
		<br><br>

		<label class="dark label2"><b class="dark">Salary:</b></label>
		<input class="form-control inputsize inline-flex align" type="text" name="sal" value="<?php echo $sal;?>"><br><br>

		<label class="dark label2"><b class="dark">No. Of Hires:</b></label>
		<input class="form-control inputsize inline-flex align" type="text" name="hires" value="<?php echo $hires;?>"><br><br>

		<label class="dark label2"><b class="dark">Job Summary:</b></label>
		<textarea rows=10 class="form-control inputsize inline-flex align" type="text" name="jobsum"><?php echo $jobsum;?></textarea><br><br>

		<label class="dark label2"><b class="dark">Responsibilities and Duties:</b></label>
		<textarea rows=10 class="form-control inputsize inline-flex align" type="text" name="desc1"><?php echo $desc1;?></textarea> <br><br>

		<label class="dark label2"><b class="dark">Required Experiences, Skills and Qualifications:</b></label>
		<textarea rows=10 class="form-control inputsize inline-flex align" type="text" name="desc2"><?php echo $desc2;?></textarea><br><br>

		<label class="dark label2"><b class="dark">Benefits:</b></label>
		<textarea rows=10 class="form-control inputsize inline-flex align" type="text" name="desc3"><?php echo $desc3;?></textarea><br><br>

		<label class="dark label2"><b class="dark">Email:</b></label>
		<input class="form-control inputsize inline-flex align" type="text" name="email" value="<?php echo $email;?>"><br><br>

		<label class="dark label2"><b class="dark">Last date to apply:</b></label>
		<input class="form-control inputsize inline-flex align" type="date" name="last_date" value="<?php echo strftime('%Y-%m-%d',strtotime($last_date));?>"><br><br>

		<div align="center">
			<input type="hidden" name="id" value="<?php echo base64_decode($_GET['id']);?>">
			<input class="btn" type="submit" name="updatejob" value="Update">
		</div>	
	</form>
</div><br>

<?php

include 'footer.php';

?>