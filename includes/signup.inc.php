<?php 
session_start();

if(isset($_POST['register']))
{
	include_once 'dbh.inc.php';

	$first= htmlentities(mysqli_real_escape_string($conn,$_POST['first']));
	$last= htmlentities(mysqli_real_escape_string($conn,$_POST['last']));
	$email= htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
	$mobile=htmlentities(mysqli_real_escape_string($conn,$_POST['mobile']));
	$loc=htmlentities(mysqli_real_escape_string($conn,$_POST['loc']));
	$dob=htmlentities(mysqli_real_escape_string($conn,$_POST['dob']));
	$uid= htmlentities(mysqli_real_escape_string($conn,$_POST['uid']));
	$gen= htmlentities(mysqli_real_escape_string($conn,$_POST['gender']));
	$pwd= htmlentities(mysqli_real_escape_string($conn,$_POST['pwd']));

		if(!preg_match("/^[a-zA-Z\\s]*$/",$first) || !preg_match("/^[a-zA-Z\\s]*$/",$last))
		{
			header("Location: ../signup.php?signup=empty");
			exit();
		} 
		else
		{
			$sql= "SELECT * FROM users WHERE user_email='$email'";
			$result= mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);

			if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $resultCheck>0)
			{
				header("Location: ../signup.php?signup=invalid_email");
				exit();
			} 
			else
			{
				$sql= "SELECT * FROM users WHERE user_uid='$uid'";
				$result= mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if($resultCheck>0)
				{
					header("Location: ../signup.php?signup=usertaken");
					exit();
				} 
				else
				{
					// Hashing password
					$hashedPwd= password_hash($pwd, PASSWORD_DEFAULT);
					// Insert the user into the database

					$rndno=rand(100000,999999);
					$message = urlencode("confirmation code.".$rndno);

					$sql= "INSERT INTO users(user_first,user_last,mobile,location,user_email,user_uid,dob,gender,user_password,account_status) VALUES('$first','$last','$mobile','$loc','$email','$uid','$dob','$gen','$hashedPwd','Not Confirmed')";
					$result=mysqli_query($conn,$sql);


					$to=$_POST['email'];
					$_SESSION['otp']=$rndno;
					$subject = "Code for account confirmation";
					$txt = "Confirmation code: ".$rndno."";
					mail($to,$subject,$txt);
					

					header("Location: ../confirm_user.php");
					
				}
			}
		}	
}

else if(isset($_POST['submit']))
{
	include_once 'dbh.inc.php';

	$qual= htmlentities(mysqli_real_escape_string($conn,$_POST['hq']));
	$course= htmlentities(mysqli_real_escape_string($conn,$_POST['course']));
	$pgcourse= htmlentities(mysqli_real_escape_string($conn,$_POST['pgcourse']));
	$spec= htmlentities(mysqli_real_escape_string($conn,$_POST['spec']));
	$uni= htmlentities(mysqli_real_escape_string($conn,$_POST['uni']));
	$pyear= htmlentities(mysqli_real_escape_string($conn,$_POST['pyear']));
	$perc= htmlentities(mysqli_real_escape_string($conn,$_POST['perc']));
	$hperc= htmlentities(mysqli_real_escape_string($conn,$_POST['hperc']));
	$hboard= htmlentities(mysqli_real_escape_string($conn,$_POST['hboard']));
	$hyear= htmlentities(mysqli_real_escape_string($conn,$_POST['hyear']));
	$sperc= htmlentities(mysqli_real_escape_string($conn,$_POST['sperc']));
	$sboard= htmlentities(mysqli_real_escape_string($conn,$_POST['sboard']));
	$syear= htmlentities(mysqli_real_escape_string($conn,$_POST['syear']));
	$uid= htmlentities(mysqli_real_escape_string($conn,$_POST['uid']));

	$name = $_FILES['resume']['name'];
	$target_dir = "documents/";
	$target_file = $target_dir . basename($_FILES["resume"]["name"]);

		 // Select file type
	$docFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		 // Valid file extensions
	$extensions_arr = array("docx","doc","pdf");

		 // Check extension
	if(in_array($docFileType,$extensions_arr))
	{
		// Insert record
		$fetch_doc="SELECT * FROM resume WHERE user_id='$SESSION'";
		$res_doc=mysqli_query($conn,$fetch_doc);

		if(mysqli_num_rows($res_doc)==0)
		{
			$query = "INSERT INTO resume(user_id,name) VALUES('$SESSION','$name')";
			mysqli_query($conn,$query);
		}
		else
		{
			$query = "UPDATE resume SET name='$name' WHERE user_id='$SESSION'";
			mysqli_query($conn,$query);
		}
			  // Upload file
		move_uploaded_file($_FILES['resume']['tmp_name'],$target_dir.$name);
	// Error handlers
	// Check for empty fields

	/*if(empty($hperc) || empty($hboard) || empty($hyear) || empty($sperc) || empty($sboard) || empty($syear)){
		echo "<script language=\"Javascript\">\n";
		echo "window.location='../details.php?uid=$uid'";
		echo "alert('Field is empty');\n";
		echo "</script>";
	}
					else
					{
						// Check if input characters are valid
						if((is_nan($pyear)) || (is_nan($perc)) || (is_nan($hperc)) || (is_nan($hyear)) || (is_nan($sperc)) || (is_nan($syear)))
						{
									echo "<script language=\"Javascript\">\n";
									echo "window.location='../details.php?uid=$uid'";
									echo "alert('Incorrect input. Numeric value required');\n";
									echo "</script>";
									exit();
						}
						else
						{
							if(($perc>100 || $perc<0) || ($hperc>100 || $hperc<0) || ($sperc>100 || $sperc<0))
							{
									echo "<script language=\"Javascript\">\n";
									echo "window.location='../details.php?uid=$uid'";
									echo "alert('Incorrect percentage range');\n";
									echo "</script>";
									exit();
							}
							else
							{
								if($pyear==$hyear || $pyear==$syear || $hyear==$syear || $pyear<$hyear || $hyear<$syear || $pyear<$syear)
								{
									echo "<script language=\"Javascript\">\n";
									echo "window.location='../details.php?uid=$uid'";
									echo "alert('Incorrect sequence of year');\n";
									echo "</script>";
									exit();
								}
								else
								{
									if(($pyear-$hyear<3) || ($pyear-$syear<6) || ($hyear-$syear<2))
									{
										echo "<script language=\"Javascript\">\n";
										echo "window.location='../details.php?uid=$uid'";
										echo "alert('Invalid year difference');\n";
										echo "</script>";
										exit();
									}
									else
									{*/

	}

									$sql= "INSERT INTO details(user_id,highest_qualification,course,pg_course,specialization,university,passing_year,percentage,hsc_percentage,hsc_board,hsc_year,ssc_percentage,ssc_board,ssc_year) VALUES('$uid','$qual','$course','$pgcourse','$spec','$uni','$pyear','$perc','$hperc','$hboard','$hyear','$sperc','$sboard','$syear')";
									mysqli_query($conn,$sql);

										
										header("Location: ../candidate/userdocs.php");
									
										exit();
							
				
}

		

else if(isset($_POST['recsubmit']))
{
	include_once 'dbh.inc.php';

	$first= $_POST['first'];
	$last= $_POST['last'];
	$email= $_POST['email'];
	$uid= $_POST['uid'];
	$pwd= $_POST['pwd'];
	$des= $_POST['des'];
	$cmp= $_POST['cmp'];
	$ind= $_POST['ind'];
	$addr= $_POST['addr'];
	$city= $_POST['city'];
	$mobile= $_POST['mobile'];
	$gst= $_POST['gst'];

	// Error handlers
	// Check for empty fields

			$sql= "SELECT * FROM recruiter WHERE recruiter_email='$email'";
			$result= mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);

			if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $resultCheck>0) 
			{
				header("Location: ../index.php?signup=invalid_email");
				exit();
			} 
			else
			{
				$sql= "SELECT * FROM recruiter WHERE recruiter_uid='$uid'";
				$result= mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if($resultCheck>0){
				header("Location: ../index.php?signup=usertaken");
				exit();
				} 
				else
				{
					if(is_nan($mobile))
					{
						header("Location: ../index.php?signup=invalid_mobileno");
						exit();
					}
					else
					{
						if(strlen($mobile)!=10)
						{
							header("Location: ../index.php?signup=invalid_mobileno");
							exit();
						}
					
						else
						{

							// Hashing password
							$hashedPwd= password_hash($pwd, PASSWORD_DEFAULT);
							// Insert the user into the database
							$rndno=rand(100000, 999999);
							$message = urlencode("confirmation code.".$rndno);

							$sql= "INSERT INTO recruiter(recruiter_first,recruiter_last,recruiter_email,recruiter_uid,recruiter_password,recruiter_designation,company_name,industry,office_addr,city,mobileno,gst,account_status) VALUES ('$first','$last','$email','$uid','$hashedPwd','$des','$cmp','$ind','$addr','$city','$mobile','$gst','Not Confirmed')";

							mysqli_query($conn,$sql);

							$to=$_POST['email'];
							$_SESSION['otp']=$rndno;
							$subject = "Code for account confirmation";
							$txt = "Confirmation code: ".$rndno."";
							mail($to,$subject,$txt);

							header("Location: ../confirm_rec.php");
							
							exit();
						}
					}
				}
			}
	
}
	else{
	header("Location: index.php");
	exit();
}

?>