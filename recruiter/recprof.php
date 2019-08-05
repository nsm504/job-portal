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
		$image_src = "../img/profile/".$image;
	}
		
	$_SESSION['recId']= $SESSION;
 ?>
<body>
	<br><br><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3" style="margin-top:-50px;">
			<?php  
				echo '<div class="menu-content ">'; 						
				if($result->num_rows>0)
				{
					while($row=$result->fetch_assoc())
					{
						echo '<h3 style="color:white;" align="center" >Welcome'.' '.$row["recruiter_first"].' '.$row["recruiter_last"].'!</h3><br>' ; 

					}
				}
				echo '  <b><div class="text-center">
							<img style="background-image:url(../img/user.png); background-repeat:no-repeat; background-position:center; background-color:#cdcdcd;" src="';echo $image_src; echo'"   class="avatar img-circle " ><br><br>
									 
								<form method="post" action="../imgupload.inc.php" enctype="multipart/form-data">
									&nbsp;<input type="file" name="file" class="filealign text-center center-block file-upload">
									<input type="submit" value="Upload" name="but_upload">
								</form>

							</div>';

				echo '</div>';
			?>   

			<div>
				<br>
				<a href="recdocs.php" class=""><b class="dark docs-link">Upload important documents (Required for verification)</b></a>
			</div>		

			<div>
		</div>
	</div>

	<div class="">

		<div class="tab">
			<button class="tablinks" onclick="openCity(event, 'Profile')" id="defaultOpen">Profile</button>
			<button class="tablinks" onclick="openCity(event, 'Details')">Details</button>				  
		</div>

		<div id="Profile" class="tabcontent">
			<div class="single-post">
				<form id="editRecProfile">
				<br>
					<b class="dark label ">First Name</b><input class="form-control inputsize inline-flex align" type="text" name="first" value="<?php include '../data/users/firstname.php';?>"> <br>

					<b class="dark label">Last Name</b>
					<input class="form-control inputsize inline-flex align"  type="text" name="last" value="<?php include '../data/users/lastname.php';?>"><br>
																					
					<b class="dark label">Email ID</b>
					<input class="form-control inputsize inline-flex align"  type="text" name="email" value="<?php include '../data/users/email.php';?>"><br>
													
					<b class="dark label">UserName</b>
					<input class="form-control inputsize inline-flex align"  type="text" name="uid" value="<?php include '../data/users/username.php';?>"><br><br>
												
					<button class="btn-success btn-align " type="submit" name="update">Update</button>				
				</form>

				<p class="profile"></p>
			</div>
		</div>

		<div id="Details" class="tabcontent">
			<div class="single-post ">
				<div class="">
					<form id="editRecDetails">
					<br>
						<div>
							<b class="dark label ">Designation</b><input class="form-control inputsize inline-flex align" type="text" name="des" value="<?php include '../data/recruiter/des.php';?>"><br>										

							<b class="dark label">Company</b>
							<input class="form-control inputsize inline-flex align" type="text" name="cmp" value="<?php include '../data/recruiter/cmp.php';?>"><br>

							<b class="dark label">Industry</b>
							<input class="form-control inputsize inline-flex align text-left"  type="text" name="ind" value="<?php include '../data/recruiter/ind.php';?>"><br>
																		
							<b class="dark label">Office Address</b>
							<input class="form-control inputsize inline-flex text-left"  type="text" name="addr" value="<?php include '../data/recruiter/addr.php';?>"><br>

							<b class="dark label">City</b>
							<input class="form-control inputsize inline-flex align"  type="text" name="city" value="<?php include '../data/recruiter/city.php';?>"><br>

							<b class="dark label">Contact number</b>
							<input class="form-control inputsize inline-flex align"  type="text" name="mobile" value="<?php include '../data/recruiter/mobile.php';?>"><br>

							<b class="dark label">GST</b>
							<input class="form-control inputsize inline-flex align"  type="text" name="gst" value="<?php include '../data/recruiter/gst.php';?>"><br><br>
																
							<button class="btn btn-success btn-align" type="submit" name="insertdetails">Insert</button>
																
						</div>
					</form>	
					<p class="details"></p>
				</div>				
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
	</div><br><br>
</div>
				
<?php

include 'footer.php';?>

<script src="../js/editRecProfile.js"></script>
<script src="../js/editRecDetails.js"></script>