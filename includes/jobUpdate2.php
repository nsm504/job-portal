<?php 

	include 'dbh.inc.php';
	$date= date('Y-m-d');
	$title=$cmp=$loc='';
	$count_values=array();
	$intro='';
	$body='';
	$address='';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require_once '../mailing/vendor/autoload.php';
	$mail= new PHPMailer(true);

			//echo $skill.'<br>';

	if(isset($_POST['jobUpdate']))
	{
		$sql="SELECT DISTINCT skills FROM details INNER JOIN user ON details.user_id=user.user_id WHERE account_status='Verified'";
		$query= mysqli_query($conn,$sql);

		while($row= mysqli_fetch_array($query))
		{
			$skills_arr[$row["skills"]]=$row;
		}

		foreach($skills_arr as $value)
		{
			//echo $value["skills"].'<br>';

			$skill_single= explode(",",$value["skills"]);

			foreach($skill_single as $value)
			{
				echo $value.'<br>';

				$sql="SELECT job_title,company,location,job_type,salary FROM joblist WHERE skills LIKE '%$value%' ORDER BY time DESC LIMIT 5 ";
				$query= mysqli_query($conn,$sql);

				if(mysqli_num_rows($query)==0)
				{
					continue;
				}
				else
				{
					$sql2= "SELECT user_email FROM details INNER JOIN user ON details.user_id=user.user_id WHERE skills LIKE '%$value%'";
					$query2= mysqli_query($conn,$sql2);		
									
					while($row= mysqli_fetch_array($query))
					{ 
						$title_arr[$row["job_title"]]=$row;
					}	

					while($row2= mysqli_fetch_array($query2))
					{
						$u_email[$row2["user_email"]]=$row2;  
					}	
				}					
			}			
		}
			echo '<br>'; 



		$mail->setFrom('proactivecba@gmail.com','Proactive Jobs');

		foreach($u_email as $value)
		{
			$address =$value[0];
			$mail->addBCC($address,'');
		}
							
							
		$mail->addReplyTo('proactivecba@gmail.com','Proactive Jobs');

		$mail->isHTML(true);                              
		$mail->Subject = 'Latest Job that matches your profile';

		$intro .='Greetings candidate !';
		$intro .='<br>';
		$intro .='Have a look at some of the latest jobs you might be interested in...';
		$intro .= '<br>';
		$intro .= '<br>';
		$intro .= '<br>';

		foreach($title_arr as $val) 
		{	
			$body .= $val[0];
			$body .= '<br>';
			$body .= '<br>';
			$body .= $val[1];
			$body .= '<br>';
			$body .= $val[2];
			$body .= '<br>';
			$body .= $val[3];
			$body .= '<br>';
			$body .= $val[4];
			$body .= '<br>';
			$body .= '<br>';								
		}

		$mail->Body= $intro.'<br>'.$body;
		$mail->send(); 
	
	}


?>