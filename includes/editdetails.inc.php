<?php 

session_start();
include 'dbh.inc.php';

if(isset($_SESSION['u_id']))
{
	$SESSION= $_SESSION['u_id'];

	if(isset($_POST['updatedetails']))
	{

		$qual= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['hq']));
		$course= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['course']));
		$pgcourse= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['pgcourse']));
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


			if(empty($spec) || empty($uni)  || empty($pyear) || empty($perc) || empty($hperc) || empty($hboard) || empty($hyear) || empty($sperc) || empty($sboard) || empty($syear))
			{


				header("Location: ../profile.php?edit=empty");
				exit();
				
			}

			

				else
				{
					if(is_nan($pyear) || (is_nan($perc)) || (is_nan($hperc)) || (is_nan($hyear)) || (is_nan($sperc)) || (is_nan($syear)))
					{
							header("Location: ../profile.php?edit=input_error");
							exit();
					}

					else
					{
						if(($perc>100 || $perc<0) || ($hperc>100 || $hperc<0) || ($sperc>100 || $sperc<0))
						{
							header("Location: ../profile.php?edit=invalid_percentage_value");
							exit();
						}

						else
						{
							if($pyear==$hyear || $pyear==$syear || $hyear==$syear || $pyear<$hyear || $hyear<$syear || $pyear<$syear)
							{
								echo "<script language=\"Javascript\">\n";
								echo "alert('Incorrect sequence of year');\n";
								echo "window.location='../profile.php'";
								echo "</script>";

								
								exit();

							}
							else
							{
								if(($pyear-$hyear<3) || ($pyear-$syear<6) || ($hyear-$syear<2))
								{
									echo "<script language=\"Javascript\">\n";
									echo "alert('Invalid year difference');\n";
									echo "window.location='../profile.php'";
									echo "</script>";

									
									exit();
								}

								else
								{

									if($qual=='Graduate')
									{
										$pgcourse='';
									}
										$sql= "UPDATE details SET highest_qualification='$qual',course='$course',pg_course='$pgcourse',specialization='$spec',university='$uni',passing_year='$pyear',skills='$skills',percentage='$perc',hsc_percentage='$hperc',hsc_board='$hboard',hsc_year='$hyear',ssc_percentage='$sperc',ssc_board='$sboard',ssc_year='$syear' WHERE user_id='$SESSION'";

										$result= mysqli_query($conn,$sql);
										$resultCheck= mysqli_num_rows($result);
										header("Location: ../profile.php#Details?update=success");
										exit();
										
																		
								}
							}
						}


					}

				}
			
	}
	else if(isset($_POST['insertdetails']))
	{

		$qual= $_POST['hq'];
		$course= $_POST['course'];
		$spec= $_POST['spec'];
		$uni= $_POST['uni'];
		$pyear= $_POST['pyear'];
		$skills= $_POST['skills'];
		$perc= $_POST['perc'];
		$hperc= $_POST['hperc'];
		$hboard= $_POST['hboard'];
		$hyear= $_POST['hyear'];
		$sperc= $_POST['sperc'];
		$sboard= $_POST['sboard'];
		$syear= $_POST['syear'];


			if(empty($qual) || empty($course) || empty($spec) || empty($uni)  || empty($pyear) || empty($skills) || empty($perc) || empty($hperc) || empty($hboard) || empty($hyear) || empty($sperc) || empty($sboard) || empty($syear))
			{


				header("Location: ../profile.php?edit=empty");
				exit();
				
			}

			else
			{
				if(!preg_match("/^[a-zA-Z\\s]*$/",$uni)  || !preg_match("/^[a-zA-Z\\s,]*$/",$skills) || !preg_match("/^[a-zA-Z\\s]*$/",$hboard) || !preg_match("/^[a-zA-Z\\s]*$/",$sboard))
				{

					header("Location: ../profile.php?details=input_error");
					exit();
				} 


				else
				{
					if(is_nan($pyear) || (is_nan($perc)) || (is_nan($hperc)) || (is_nan($hyear)) || (is_nan($sperc)) || (is_nan($syear)))
					{
							header("Location: ../profile.php?details=input_error");
							exit();
					}

					else
					{
						if(($perc>100 & $perc<0) || ($hperc>100 & $hperc<0) || ($sperc>100 & $sperc<0))
						{
							header("Location: ../profile.php?details=invalid_percentage_value");
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

								header("Location: ../profile.php?edit=invalid_year_sequence");
								exit();
							}

							else
							{
								if(($pyear-$hyear<3) || ($pyear-$syear<6) || ($hyear-$syear<2))
								{
									echo "<script language=\"Javascript\">\n";
									echo "alert('Invalid year difference');\n";
									echo "window.location='../profile.php'";
									echo "</script>";

									
									exit();
								}
		
								else
								{
										$sql= "INSERT INTO userprofile(highest_qualification,course,specialization,university,passing_year,skills,percentage,hsc_percentage,hsc_board,hsc_year,ssc_percentage,ssc_board,ssc_year,user_id) VALUES ('$qual','$course','$spec','$uni','$pyear','$skills','$perc','$hperc','$hboard','$hyear','$sperc','$sboard','$syear','$SESSION')";

										$result= mysqli_query($conn,$sql);
										$resultCheck= mysqli_num_rows($result);
										header("Location: ../profile.php?input=success");
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