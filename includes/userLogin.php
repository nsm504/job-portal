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
		$sql= "SELECT * FROM user WHERE user_uid= '$uid' OR user_email='$uid'";
		$result= mysqli_query($conn,$sql);
		$resultCheck= mysqli_num_rows($result);
		if($resultCheck<1){
			echo '<b><b class="text-danger">Email ID that you&apos;ve entered is incorrect.</b></b>';
			exit();
		} else{
			if($row = mysqli_fetch_assoc($result)){
				// De-hashing the password
				$hashedPwdCheck = password_verify($pwd,$row['user_password']);
				if($hashedPwdCheck == false){
				echo '<b><b class="text-danger">Password that you&apos;ve entered is incorrect.</b></b>';
				exit();
				} else if($hashedPwdCheck == true){
					// Login the user here !
					if($row["account_status"]=='Deactivated')
					{
						echo '<b><b class="text-danger">Your account has been deactivated. Please contact the administrator to restore your account.</b></b>';
					}
					else
					{
						$_SESSION['u_id'] = $row['user_id'];
						$_SESSION['u_first'] = $row['user_first'];
						$_SESSION['u_last'] = $row['user_last'];
						$_SESSION['u_email'] = $row['user_email'];
						$_SESSION['u_uid'] = $row['user_uid'];

						echo '<b><b class="text-success">Login successful.</b></b>';
						exit();
					}
				}
			}
		}
	}
} 