<?php 

session_start();
include 'dbh.inc.php';
$output='';

if(isset($_SESSION['u_id']))
{
	$SESSION= $_SESSION['u_id'];

	
	if(!empty($_POST))
	{
		
		$jd=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['jd']));
		$cmp=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['cmp']));
		$dur=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['dur']));
		/*$start=$_POST['start'];
		$end=$_POST['end'];*/


			if(empty($jd) || empty($cmp))
			{


				header("Location: ../profile.php?edit=empty");
				exit();
				
			}

			else
			{
				if(!preg_match("/^[a-zA-Z\\s]*$/",$jd)  || !preg_match("/^[a-zA-Z\\s,]*$/",$cmp))
				{

					header("Location: ../profile.php?editdetails=input_error");
					exit();
				} 



						else
						{
							$sql= "INSERT INTO experience(user_id,job_designation,company,duration) VALUES('$SESSION','$jd','$cmp','$dur')";

							$result= mysqli_query($conn,$sql);

							$output.= '	<thead>
											<tr id="trr">
												<th id="thh">Job Designation</th>
												<th id="thh">Company</th>
												<th id="thh">Duration</th>
											</tr>
										</thead>

										<tbody>';

							$sql2="SELECT exp_id,job_designation,company,duration FROM experience WHERE user_id='$SESSION' ";
							$result2 = mysqli_query($conn,$sql2);

							while($row2 = mysqli_fetch_array($result2)) 
							{ 
								$id=base64_encode($row2["exp_id"]);

								$output.= '		<tr id="trr">
													<td id="tdd">'.$row2["job_designation"].'</td>
													<td id="tdd">'.$row2["company"].'</td>
													<td id="tdd">'.$row2["duration"].'</td>
												</tr>';
							}				
						}

			}
			
			
	}

	echo $output;
}





 ?>