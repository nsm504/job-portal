<?php 

session_start();

if(!empty($_POST))
{
	include '../includes/dbh.inc.php';

	$username= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['username']));
	$password= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['password']));
	
	//Error handlers
	//Check if inputs are empty

	if(empty($username) || empty($password))
	{
		echo '<b><b class="text-danger">Field is empty.</b></b>';
		exit();
	} 
	else
	{
		$sql= "SELECT * FROM admin WHERE admin_name= '$username'";
		$result= mysqli_query($conn,$sql);
		$resultCheck= mysqli_num_rows($result);
		if($resultCheck<1)
		{
			echo '<b><b class="text-danger">Admin username that you&apos;ve entered is incorrect.</b></b>';
			exit();
		} 
		else
		{
			if($row = mysqli_fetch_assoc($result))
			{
				// De-hashing the password
				$hashedPwdCheck = password_verify($password,$row["admin_password"]);
				if($hashedPwdCheck == false)
				{
					echo '<b><b class="text-danger">Password that you&apos;ve entered is incorrect.</b></b>';
					exit();
				} 
				else if($hashedPwdCheck == true)
				{
						// Login the admin here !

					$_SESSION['job_admin'] = $row["admin_id"];

					echo '<b class="text-success">Login successful.</b>';	
				}
			}
		}
	}
}


 ?>