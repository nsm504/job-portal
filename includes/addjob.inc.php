<?php 

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../mailing/vendor/autoload.php';
$mail= new PHPMailer(true);

$date= date('Y-m-d');

if(isset($_SESSION['r_id']))
{
	$SESSION=$_SESSION['r_id'];

	if(isset($_POST['submitjob']))
	{
		include_once 'dbh.inc.php';

		$title= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['title']));
		$cmp= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['cmp']));
		$loc= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['loc']));
		$type= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['type']));
		$skills= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['skills']));
		$exp= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['exp']));
		$sal= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['sal']));
		$hires= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['hires']));
		$jobsum= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['jobsum']));
		$desc1= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['desc1']));
		$desc2= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['desc2']));
		$desc3= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['desc3']));
		$email= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['email']));
		$last_date= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['last_date']));
		
		
		if(empty($title) || empty($cmp) || empty($loc) || empty($sal) || empty($skills) || empty($hires) || empty($jobsum) || empty($desc1) || empty($desc2) || empty($desc3) || empty($email) || empty($last_date))
		{
			header("Location: ../recjob.php?addjob=empty");
			exit();
		}
		else
		{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			{
				header("Location: ../recjob.php?addjob=invalid_email");
				exit();
			}
			else
			{
				if(is_nan($sal) || is_nan($hires))
				{
					header("Location: ../recjob.php?addjob=please_enter_numeric_value");
					exit();
				}
				else
				{
							$sql= "INSERT INTO joblist(recruiter_id,job_title,company,location,job_type,skills,experience,salary,no_hires,job_summary,description1,description2,description3,email,last_date,time,job_status) VALUES('$SESSION','$title','$cmp','$loc','$type','$skills','$exp','$sal','$hires','$jobsum','$desc1','$desc2','$desc3','$email','$last_date','$date','active')";

					mysqli_query($conn,$sql);
					header("Location: ../recruiter/recjob.php?signup=success");
				
					exit();


				}
			}
		}
	}
	else
	{
		header("Location: ../index.php");
		exit();
	}
}
	