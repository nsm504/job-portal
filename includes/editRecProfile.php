<?php 

session_start();
include 'dbh.inc.php';


if(isset($_SESSION['r_id']))
{
	$SESSION= $_SESSION['r_id'];

	if(!empty($_POST))
	{	
		$first= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['first']));
		$last= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['last']));
		$email= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['email']));
		$uid= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['uid']));

	// Error handlers
	// Check for empty fields

			if(empty($first) || empty($last) || empty($email) || empty($uid))
			{

				echo '<p class="ml-200"><b class="text-danger">Field is empty.</b></p>';
				
			}

		// Check if input characters are valid
			else
			{	
				if(!preg_match("/^[a-zA-Z\\s]*$/",$first) || !preg_match("/^[a-zA-Z\\s]*$/",$last))
				{

					echo '<p class="ml-200"><b class="text-danger">First name and last name should only consist of alphabets.</b></p>';
				} 
				else
				{
					$sql= "SELECT * FROM recruiter WHERE recruiter_email='$email' AND recruiter_id!='$SESSION'";
					$result= mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);

					if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $resultCheck>0)
					{
						echo '<p class="ml-200"><b class="text-danger">Email you&apos;ve entered already exists.</b></p>';
					} 
					else
					{
							$sql= "SELECT * FROM recruiter WHERE recruiter_uid='$uid' AND recruiter_id!='$SESSION'";
							$result= mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
						if($resultCheck>0)
						{
							echo '<p class="ml-200"><b class="text-danger">Username you&apos;ve entered already exists.</b></p>';
						}

							else
							{

								$sql= "UPDATE recruiter SET recruiter_first='$first',recruiter_last='$last', recruiter_email='$email',recruiter_uid='$uid' WHERE recruiter_id='$SESSION'";
								$result= mysqli_query($conn, $sql);
								
								echo '<p class="ml-200"><b class="text-success">Profile edited successfully.</b></p>';
							}
						
					}
				}
			}
	}
}