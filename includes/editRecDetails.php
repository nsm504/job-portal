<?php 

session_start();
include 'dbh.inc.php';

if(isset($_SESSION['r_id']))
{
	$SESSION= $_SESSION['r_id'];

	if(!empty($_POST))
	{
		$designation=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['des']));
		$company=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['cmp']));
		$industry=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['ind']));
		$address=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['addr']));
		$city=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['city']));
		$mobile=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['mobile']));
		$gst=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['gst']));


		if(!preg_match("/^[0-9]*$/",$mobile))
		{
			echo '<p class="ml-200"><b class="text-danger">Invalid mobile number.</b></p>';
		}
		else
		{
			if(strlen($mobile)!=10)
			{
				echo '<p class="ml-200"><b class="text-danger">Mobile number should be exactly 10 digits.</b></p>';	
			}
			else
			{
				$sql= "UPDATE recruiter SET recruiter_designation='$designation', company_name='$company', industry='$industry', office_addr='$address', city='$city', mobileno='$mobile', gst='$gst' WHERE recruiter_id='$SESSION'";
				mysqli_query($conn,$sql);

				echo '<p class="ml-200"><b class="text-success">Recruiter Details successfully updated.</b></p>';				
			}
		}
	}
	else
	{
		header("Location: ../index.php");
		exit();
	}
}

?>