<?php 
session_start();
include 'dbh.inc.php';
$output='';


if(isset($_SESSION['u_id']))
{
	$SESSION=$_SESSION['u_id'];

	if(!empty($_POST))
	{
		$skill=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['skill']));

		$fetch="SELECT skills FROM details WHERE user_id='$SESSION' AND skills!='' ";
		$val=mysqli_query($conn,$fetch);

		if(mysqli_num_rows($val)>0)
		{
			$sql="UPDATE details SET skills=concat(skills,',$skill') WHERE user_id='$SESSION' ";
			$result=mysqli_query($conn,$sql);

			$output.= 	'<thead>
							<tr id="">
								<th id="thh">Skills</th>								
							</tr>
						</thead>
						';
			$sql2="SELECT skills FROM details WHERE user_id='$SESSION'";
			$result2=mysqli_query($conn,$sql2);

			while($row2=mysqli_fetch_array($result2))
			{
				$skills=$row2["skills"];
				$skill_arr=explode(',',$skills);

				foreach ($skill_arr as $value) 
				{
					$output.=	'<tr id="">
									<td id="thh">'.$value.'</td>
								</tr>';
				}
			}
		}
		else
		{
			$sql="UPDATE details SET skills='$skill' WHERE user_id='$SESSION'";
			$result=mysqli_query($conn,$sql);

			$output.= 	'<thead>
							<tr id="">
								<th id="thh">Skills</th>								
							</tr>
						</thead>
						';
			$sql2="SELECT skills FROM details WHERE user_id='$SESSION'";
			$result2=mysqli_query($conn,$sql2);

			while($row2=mysqli_fetch_array($result2))
			{
				$skills=$row2["skills"];
				$skill_arr=explode(',',$skills);

				foreach ($skill_arr as $value) 
				{
					$output.=	'<tr id="">
									<td id="thh">'.$value.'</td>
								</tr>';
				}
			}

		}

		echo $output;

	}
}

?>

