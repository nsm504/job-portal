
<?php 
session_start();

include 'nav.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'mailing/vendor/autoload.php';
$mail= new PHPMailer(true);

if(!isset($_SESSION['u_id']))
{
	$jid=$_GET['id'];
	header("Location: viewjob.php?id=$jid&job=signin");
}
else
{
	$SESSION=$_SESSION['u_id'];
	include 'includes/dbh.inc.php';

	$job=$_GET['id'];
	$jid=base64_decode($_GET['id']);

	$app_fetch="SELECT * FROM applications WHERE job_id='$jid' AND user_id='$SESSION'";
	$app_query=mysqli_query($conn,$app_fetch);

	if(mysqli_num_rows($app_query)>0)
	{
		header("Location: viewjob.php?id=$job&job=rpt");
	}
	else 
	{
		$verified= "SELECT * FROM user WHERE account_status='Verified' AND user_id='$SESSION'";
		$res_query=mysqli_query($conn,$verified);

		if(mysqli_num_rows($res_query)==0)
		{
			header("Location: viewjob.php?id=$job&job=res");
		}
		else
		{
			$date = date('Y-m-d H:i:s');

			$sql2="SELECT user_first,user_last,user_email,highest_qualification,course,specialization,university,passing_year,percentage,skills FROM details INNER JOIN user ON details.user_id=user.user_id WHERE user.user_id='$SESSION'";
			$result2=mysqli_query($conn,$sql2);

			$sql3="SELECT joblist.recruiter_id,joblist.job_title,joblist.company,recruiter.recruiter_first,recruiter.recruiter_last,recruiter.recruiter_email FROM joblist INNER JOIN recruiter ON joblist.recruiter_id=recruiter.recruiter_id WHERE job_id='$jid'";
			$result3=mysqli_query($conn,$sql3);

			$checkrow1=mysqli_num_rows($result);
			$checkrow2=mysqli_num_rows($result2);

			while($row2=mysqli_fetch_array($result2))
			{
				$first=$row2["user_first"];
				$last=$row2["user_last"];
				$user_email=$row2["user_email"];
				$highest_qualification= $row2["highest_qualification"];
				$course= $row2["course"];
				$specialization= $row2["specialization"];
				$university= $row2["university"];
				$passing_year= $row2["passing_year"];
				$percentage= $row2["percentage"];
				$skills= $row2["skills"];
			}

			while($row3=mysqli_fetch_array($result3))
			{
				$rid=$row3["recruiter_id"];
				$title=$row3["job_title"];
				$company=$row3["company"];
				$rec_email=$row3["recruiter_email"];
			}

			
			$query="INSERT INTO applications(user_id,job_id,recruiter_id,highest_qualification,course,specialization,university,passing_year,percentage,skills,status,app_date) VALUES('$SESSION','$jid','$rid','$highest_qualification','$course','$specialization','$university','$passing_year','$percentage','$skills','pending','$date')";

			$query_output=mysqli_query($conn,$query);

			try{

				    //Server settings
			    /*$mail->SMTPDebug = 1;                                       // Enable verbose debug output
			    $mail->isSMTP();                                            // Set mailer to use SMTP
			    $mail->Host       = 'smtp.sendgrid.net';                    // Specify main and backup SMTP servers
			    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			    $mail->Username   = 'user@example.com';                     // SMTP username
			    $mail->Password   = 'secret';                               // SMTP password
			    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
			    $mail->Port       = 587;            */                        // TCP port to connect to
				
				$mail->setFrom('proactivecba@gmail.com','Proactive Jobs');
				$mail->addAddress($rec_email,$row3["recruiter_first"].' '.$row3["recruiter_last"]);
				$mail->addReplyTo($user_email,$first.' '.$last);

				$mail->isHTML(true);      
				$mail->Subject = 'Applicant for the post of '.$title.' at '.$company.' Job ID:'.$jid.'';                        
				$mail->Body = '	<html>	
									<head>
									<link rel="stylesheet" href="css/main.css">
									</head>
									<body>
										<div class="post-list">
											<div class="single-post" style="padding:30px;background-color:#cce4ff;margin-bottom: 30px;box-shadow:2px 2px 2px 0px;">
												<div align="center">
													<p align="center" style="background-color:#fff; width:50%; padding:50px; font-size:22px;">'.$first.' '.$last.' has applied for the job that you posted. <br/> Applicant email ID: '.$user_email.'
													</p>
													<p style="margin-top:2px;">
                    									Copyright &copy;Proactive '.date('Y').' All right reserved. By <a href="http://www.cbaindia.in/" target="_blank"> Proactive CBA</a>
                 									</p>
												</div>
											</div>
										</div>
									</body>
								</html>';
				$mail->send();
			}
			catch(Exception $e)
			{
				echo "Unable to send mail. Mailer Error: {$mail->ErrorInfo}";
			}
			
			
			$notif="INSERT INTO notifications(sender_id,receiver_id,job_id,name,type,message,status,notif_date) VALUES('$SESSION','$rid','$jid','$first','Job Application','$first $last has applied for job of $title','unread','$date')";


			$query_notif=mysqli_query($conn,$notif);

			header("Location: viewjob.php?id=$job&job=applied");
		}
	}
}

?>
