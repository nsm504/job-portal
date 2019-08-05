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
	<br><br><br><br>
	<section class="banner-area relative" id="home">	
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content-signup col-lg-12">
					<h1 class="text-white">
						Schedule Job Interview	
					</h1>
				</div>											
			</div>
		</div>
	</section>

	<?php 	
		include "../includes/dbh.inc.php";

		$uid=$_GET['uid'];
		$uid_arr=explode(",",$uid);

		$user_id=implode("','",$uid_arr);
				
		$sql=" SELECT user_first,user_last,user_email FROM user WHERE user_id IN('$user_id')";
		$result = mysqli_query($conn,$sql);

	?>

	<div align="center" id="first">
		<br><br>
		<h3>Mail for shortlisted candidate</h3>
		<form method="post" action="../includes/sendmail.inc.php">
					
			<input class="form-control inputsize inline-flex align" type="hidden" name="mailTo" value="<?php while($row = mysqli_fetch_array($result)) 
						{  
							echo $row["user_email"].',';								
						} 
			?>">
			<br><br>

			<label class="dark label2"><b class="dark">Subject:</b></label>
			<input class="form-control inputsize inline-flex align" type="text" name="mailSub" value="<?php ?>Interview Call Letter"><br><br>

			<label class="dark label2"><b class="dark">Message:</b></label>
			<textarea rows="35" class="form-control inputsize" type="text" name="message" value="">Dear Candidate,
				Thank you for applying to [Company_name].

Your application for the [Job_title] position stood out to us and we would like to invite you for the selection process being conducted at

LOCATION DETAILS:



Please report to above mention venue at [Time].

ELIGIBILITY CRITERIA:
-
-
-
-
-

MANDATORY DOCUMENTS TO BE CARRIED:
-
-
-
-
-

All the best / Kind regards,

[Name]

						
			</textarea><br><br>

			<div align="center">
				<input type="hidden" name="uid" value="<?php echo $uid;?>">
				<input class="btn" type="submit" name="sendmail" value="Send Mail">
			</div>
				
		
		</form>
	</div>
	<?php 

	?>
</body>
</html>