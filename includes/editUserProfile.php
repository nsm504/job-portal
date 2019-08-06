<?php 

session_start();
include 'dbh.inc.php';

if(isset($_SESSION['u_id']))
{
	$SESSION= $_SESSION['u_id'];

	if(!empty($_POST))
	{
		
		$first= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['first']));
		$last= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['last']));
		$mobile= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['mobile']));
		$loc= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['loc']));
		$email= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['email']));
		$uid= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['uid']));
		$dob= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['dob']));
		$gender= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['gender']));

	// Error handlers
	// Check for empty fields

			if(empty($first) || empty($last) || empty($mobile) || empty($loc) || empty($email) || empty($uid) || empty($dob) || empty($gender))
			{


				header("Location: ../profile.php?edit=empty");
				exit();
				
			}

		// Check if input characters are valid
			else
			{	
				if(!preg_match("/^[a-zA-Z\\s]*$/",$first) || !preg_match("/^[a-zA-Z\\s]*$/",$last))
				{

					echo '<p class="ml-200"><b class="text-danger">Invalid input for first/last name.</b></p>';
				} 
				else
				{
					if(strlen($mobile)!=10)
					{
						echo '<p class="ml-200"><b class="text-danger">Mobile number should be exactly 10 digits.</b></p>';
					}
					else
					{
						if(is_nan($mobile)==true)
						{
							echo '<p class="ml-200"><b class="text-danger">Please enter a valid mobile number.</b></p>';
						}
						else
						{
							$sql= "SELECT * FROM user WHERE user_email='$email' AND user_id!='$SESSION'";
							$result= mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);

							if (!filter_var($email, FILTER_VALIDATE_EMAIL))
							{
								echo '<p class="ml-200"><b class="text-danger">Invalid email format.</b></p>';
							} 
							else 
							{
								if($resultCheck>0)
								{
									echo '<p class="ml-200"><b class="text-danger">Email entered already exists. Please type another Email ID.</b></p>';
								}
								else
								{
										$sql= "SELECT * FROM user WHERE user_uid='$uid' AND user_id!='$SESSION'";
										$result= mysqli_query($conn, $sql);
										$resultCheck = mysqli_num_rows($result);
									if($resultCheck>0)
									{
											echo '<p class="ml-200"><b class="text-danger">Username entered already exists. Please type another Username.</b></p>';
									}

										else
										{

											$sql= "UPDATE user SET user_first='$first',user_last='$last',mobile='$mobile',location='$loc', user_email='$email',user_uid='$uid',dob='$dob',gender='$gender' WHERE user_id='$SESSION'";
											$result= mysqli_query($conn, $sql);

											echo '<p class="ml-200"><b class="text-success">Profile edited successfully.</b></p>';
										}
								
								}
							}
						}
					}			
				}	
			}
	}
}		







 ?>