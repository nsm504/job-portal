<?php 

session_start();
include 'dbh.inc.php';


if(isset($_SESSION['u_id']))
{
	$SESSION= $_SESSION['u_id'];

	if(!empty($_POST))
	{
		$qual= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['hq']));
		$course= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['course']));
		$pgcourse= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['pgcourse']));
		$spec= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['spec']));
		$uni= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['uni']));
		$pyear= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['pyear']));
		$perc= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['perc']));
		$hperc= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['hperc']));
		$hboard= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['hboard']));
		$hyear= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['hyear']));
		$sperc= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['sperc']));
		$sboard= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['sboard']));
		$syear= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['syear']));


			if(empty($spec) || empty($uni)  || empty($pyear) || empty($perc) || empty($hperc) || empty($hboard) || empty($hyear) || empty($sperc) || empty($sboard) || empty($syear))
			{


				echo '<p class="ml-200"><b class="text-danger">Field is empty.</b></p>';
				
			}

				else
				{
					if(is_nan($pyear) || (is_nan($perc)) || (is_nan($hperc)) || (is_nan($hyear)) || (is_nan($sperc)) || (is_nan($syear)))
					{
						echo '<p class="ml-200"><b class="text-danger">Non-numeric values are not allowed for percentage and year fields.</b></p>';
					}

					else
					{
						if(($perc>100 || $perc<0) || ($hperc>100 || $hperc<0) || ($sperc>100 || $sperc<0))
						{
							echo '<p class="ml-200"><b class="text-danger">Invalid percentage value.</b></p>';
						}

						else
						{
							if($pyear==$hyear || $pyear==$syear || $hyear==$syear || $pyear<$hyear || $hyear<$syear || $pyear<$syear)
							{
								echo '<p class="ml-200"><b class="text-danger">Incorrect year sequence.</b></p>';
							}
							else
							{
								if(($pyear-$hyear<3) || ($pyear-$syear<5) || ($hyear-$syear<2))
								{
									echo '<p class="ml-200"><b class="text-danger">Incorrect year sequence.</b></p>';
								}

								else
								{

									if($qual=='Graduate')
									{
										$pgcourse='';
									}
										$sql= "UPDATE details SET highest_qualification='$qual',course='$course',pg_course='$pgcourse',specialization='$spec',university='$uni',passing_year='$pyear',percentage='$perc',hsc_percentage='$hperc',hsc_board='$hboard',hsc_year='$hyear',ssc_percentage='$sperc',ssc_board='$sboard',ssc_year='$syear' WHERE user_id='$SESSION'";

										$result= mysqli_query($conn,$sql);
										
										echo '<p class="ml-200"><b class="text-success">User details successfully updated.</b></p>';
																		
								}
							}
						}


					}

				}
			
	}
}





 ?>