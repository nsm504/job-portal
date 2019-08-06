<?php 

session_start();

if(isset($_SESSION['r_id']))
{
	$SESSION=$_SESSION['r_id'];

	if(isset($_POST['updatejob']))
	{
		include_once 'dbh.inc.php';

		$id=mysqli_real_escape_string($conn,$_POST['id']);
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
 		
		
		if(empty($title) || empty($cmp) || empty($loc) || empty($sal) || empty($skills) || empty($hires) || empty($email) || empty($jobsum) || empty($desc1) || empty($desc2) ||empty($desc3))
		{
			header("Location: ../recjob.php?addjob=empty");
			exit();
		}
		else
		{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
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
					$sql= "UPDATE joblist SET job_title='$title',company='$cmp',location='$loc',job_type='$type',skills='$skills',experience='$exp', salary='$sal',no_hires='$hires',job_summary='$jobsum',description1='$desc1',description2='$desc2',description3='$desc3',email='$email',last_date='$last_date' WHERE job_id='$id'";
						mysqli_query($conn,$sql);
						header("Location: ../recruiter/recjob.php?editjob=success");
					
					exit();
				}
			}
		}
	}
	else
	{
		header("Location: ../recruiter/recjob.php");
		exit();
	}
}
	