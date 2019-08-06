<?php 

include 'dbh.inc.php';
$date= date('Y-m-d');
$title=$cmp=$loc='';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../mailing/vendor/autoload.php';
$mail= new PHPMailer(true);


$sql="SELECT job_title,company,location,job_type,salary,skills FROM joblist WHERE job_status='active'";
$query= mysqli_query($conn,$sql);

while($job=mysqli_fetch_array($query))
{
	$skill_arr[$job["skills"]]=$job;
	$title_arr[$job["job_title"]]=$job;
	$cmp_arr[$job["company"]]=$job;
	$loc_arr[$job["location"]]=$job;
}

foreach($title_arr as $disp)
{
	echo $disp["job_title"].'<br>';
}

foreach($cmp_arr as $disp)
{
	echo $disp["company"].'<br>';
}

foreach($loc_arr as $disp)
{
	echo $disp["location"].'<br>';
}


foreach($skill_arr as $disp)
{
	 //echo $disp["skills"].'<br>';
	$skills= $disp["skills"];


	$skills_arr= explode(',',$skills);

	foreach($skills_arr as $skills_disp)
	{
		$skill_set[$skills_disp]=$skills_disp;
		//echo $skills_disp.'<br>';
	}
}

foreach($skill_set as $skill_single)
{
	echo $skill_single.'<br>';

	$fetch="SELECT user_email,skills FROM details INNER JOIN user ON details.user_id= user.user_id WHERE skills LIKE '%$skill_single%'";

	$result= mysqli_query($conn,$fetch);

	while($row= mysqli_fetch_array($result))
	{
		$u_email[$row["user_email"]]=$row;
		$u_skills[$row["skills"]]=$row;
	}
}

foreach($u_email as $disp)
{
	echo $disp["user_email"].'<br>';

	foreach($skill_set as $skill_single)
	{
		$send= "SELECT job_title,company,location,job_type,salary FROM joblist WHERE job_status='active' AND skills LIKE '%$skill_single%' ";
		$result= mysqli_query($conn,$send);

		while($row=mysqli_fetch_array($result))
		{
			$row["job_title"];
			$row["company"];
			$row["location"];

			$body[$row["job_title"]]=$row;
			$body[$row["company"]]=$row;
			$body[$row["location"]]=$row;

		}
	}

			try
			{
				$mail->setFrom('proactivecba@gmail.com','Proactive Jobs');
				$mail->addAddress($disp["user_email"],'');
				$mail->addReplyTo('proactivecba@gmail.com','Proactive Jobs');

				$mail->isHTML(true);                              
				$mail->Subject = 'Latest Job that matches your profile';

				foreach($body as $output)
				{
					$output= 'Hi'.$output["job_title"].'<br>'.'Hi'.$output["company"].'<br>'.'Hi'.$output["location"].'<br>';
					$mail->Body=$output; 			
				}
		
				$mail->send(); 
			}
			catch(Exception $e) 
			{
				echo "Mail not sent Mailer error:{$mail->ErrorInfo}";
			}	
}
	/*$fetch_job= "SELECT skills FROM joblist"
					$skills_arr= explode(',',$skills);

					foreach($skills_arr as $value)
					{
						$fetch_data= "SELECT user_email FROM details INNER JOIN user ON details.user_id= user.user_id WHERE skills LIKE '%$value%' ";

						$res= mysqli_query($conn,$fetch_data);

						while($row= mysqli_fetch_array($res))
						{
							$u_email= $row["user_email"];

							try
							{
								$mail->setFrom('proactivecba@gmail.com','Proactive Jobs');
								$mail->addAddress($u_email,'');
								$mail->addReplyTo('proactivecba@gmail.com','Proactive Jobs');

								$mail->isHTML(true);                              
							    $mail->Subject = 'Latest Job that matches your profile';
							    $mail->Body = '
							    				Dear Candidate,<br>
							    					New job has been posted which you might be interested in  ';

							    $mail->send();
							}
							catch(Exception $e) 
							{
								echo "Mail not sent Mailer error:{$mail->ErrorInfo}";
							}								
					
					}*/

 ?>


1. Select user_email,skills from 'details' IJ 'user'
2. $skills[$row["skills"]]=$row;
   $email[$row["user_email"]]=$row;
3. foreach($skills as $skill_arr)
4. 