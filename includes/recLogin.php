<?php 

session_start();

if(!empty($_POST))
{
	include 'dbh.inc.php';

	$uid= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['uid']));
	$pwd= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['pwd']));
	
	//Error handlers
	//Check if inputs are empty

	if(empty($uid) || empty($pwd)){
		echo '<b><b class="text-danger">Field is empty.</b></b>';
		exit();
	} else
	{
		$sql= "SELECT * FROM recruiter WHERE recruiter_uid= '$uid' OR recruiter_email='$uid'";
		$result= mysqli_query($conn,$sql);
		$resultCheck= mysqli_num_rows($result);
		if($resultCheck<1){
			echo '<b><b class="text-danger">Email ID that you&apos;ve entered is incorrect.</b></b>';
			exit();
		} else{
			if($row = mysqli_fetch_assoc($result)){
				// De-hashing the password
				$hashedPwdCheck = password_verify($pwd,$row['recruiter_password']);
				if($hashedPwdCheck == false){
				echo '<b><b class="text-danger">Password that you&apos;ve entered is incorrect.</b></b>';
				exit();
				} else if($hashedPwdCheck == true){

					if($row["account_status"]=='Deactivated')
					{
						echo '<b><b class="text-danger"><br>Your account has been deactivated.Please contact the administrator to restore your account.</b></b>';
					}
					else
					{					// Login the user here !

						$_SESSION['r_id'] = $row['recruiter_id'];
						$_SESSION['r_first'] = $row['recruiter_first'];
						$_SESSION['r_last'] = $row['recruiter_last'];
						$_SESSION['r_email'] = $row['recruiter_email'];
						$_SESSION['r_uid'] = $row['recruiter_uid'];

						echo '<b><b class="text-success">Login successful.</b></b>';	
						exit();
					}
				}
			}
		}
	}
} 