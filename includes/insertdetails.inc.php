<?php 

session_start();

if(isset($_SESSION['u_id']))
{
	$SESSION= $_SESSION['u_id'];

	if(isset($_POST['insertdetails']))
	{
		include 'dbh.inc.php';

		$qual= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['hq']));
		$course= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['course']));
		$spec= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['spec']));
		$uni= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['uni']));
		$pyear= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['pyear']));
		$skills= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['skills']));
		$perc= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['perc']));
		$hperc= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['hperc']));
		$hboard= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['hboard']));
		$hyear= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['hyear']));
		$sperc= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['sperc']));
		$sboard= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['sboard']));
		$syear= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['syear']));


			if(empty($qual) || empty($course) || empty($spec) || empty($uni)  || empty($pyear) || empty($skills) || empty($perc) || empty($hperc) || empty($hboard) || empty($hyear) || empty($sperc) || empty($sboard) || empty($syear))
			{


				header("Location: ../profile_condition.php?edit=empty");
				exit();
				
			}

			else
			{
				if(!preg_match("/^[a-zA-Z\\s]*$/",$uni)  || !preg_match("/^[a-zA-Z\\s,]*$/",$skills) || !preg_match("/^[a-zA-Z\\s]*$/",$hboard) || !preg_match("/^[a-zA-Z\\s]*$/",$sboard))
				{

					header("Location: ../profile_condition.php?details=input_error");
					exit();
				} 


				else
				{
					if(is_nan($pyear) || (is_nan($perc)) || (is_nan($hperc)) || (is_nan($hyear)) || (is_nan($sperc)) || (is_nan($syear)))
					{
							header("Location: ../profile_condition.php?details=input_error");
							exit();
					}

					else
					{
						if(($perc>100 & $perc<0) || ($hperc>100 & $hperc<0) || ($sperc>100 & $sperc<0))
						{
							header("Location: ../profile_condition.php?details=invalid_percentage_value");
							exit();
						}

						else
						{
							if($pyear==$hyear || $pyear==$syear || $hyear==$syear || $pyear<$hyear || $hyear<$syear || $pyear<$syear)
							{
								echo "<script language=\"Javascript\">\n";
								echo "alert('Incorrect sequence of year');\n";
								echo "window.location='../insertdetails.php'";
								echo "</script>";

								header("Location: ../profile_condition.php?edit=invalid_year_sequence");
								exit();
							}

							else
							{
								if(($pyear-$hyear<3) || ($pyear-$syear<6) || ($hyear-$syear<2))
								{
									echo "<script language=\"Javascript\">\n";
									echo "alert('Invalid year difference');\n";
									echo "window.location='../profile_condition.php'";
									echo "</script>";

									
									exit();
								}
		
								else
								{
										$sql= "INSERT INTO userprofile(highest_qualification,course,specialization,university,passing_year,skills,percentage,hsc_percentage,hsc_board,hsc_year,ssc_percentage,ssc_board,ssc_year,user_id) VALUES ('$qual','$course','$spec','$uni','$pyear','$skills','$perc','$hperc','$hboard','$hyear','$sperc','$sboard','$syear','$SESSION')";

										$result= mysqli_query($conn,$sql);
										$resultCheck= mysqli_num_rows($result);
										header("Location: ../profile_condition.php?input=success");
										exit();
										
																		
								}
							}
						}

					}

				}
			}
	}		
	else
	{
			header("Location: ../profile.php");
			exit();

	}
}





 ?>