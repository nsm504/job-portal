<?php
//including the database connection file
include 'includes/dbh.inc.php' ;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'mailing/vendor/autoload.php';
$mail= new PHPMailer(true);

//getting id of the data from url

	//deleting the row from table
$app2 = isset($_GET['rej']);
$date = date('Y-m-d H:i:s');

	if(isset($_GET['app']))			/* When recruiter clicks on 'accept' */
	{	
		$app1 = $_GET['app'];
		$result = mysqli_query($conn,"UPDATE applications SET status='accepted' WHERE app_id=$app1");

		$fetch1 = mysqli_query($conn,"SELECT applications.job_id,job_title,applications.recruiter_id,user_id,company,recruiter.recruiter_first,recruiter.recruiter_email FROM applications INNER JOIN recruiter ON applications.recruiter_id=recruiter.recruiter_id INNER JOIN joblist ON applications.job_id=joblist.job_id WHERE app_id=$app1");

		$row=mysqli_fetch_array($fetch1);

		$job_id=$row["job_id"];
		$job_title=$row["job_title"];
		$rec_id=$row["recruiter_id"];
		$user_id=$row["user_id"];
		$rec_name=$row["recruiter_first"];
		$rec_email=$row["recruiter_email"];
		$cmp= $row["company"];

		$fetch2= mysqli_query($conn,"SELECT user_email,user_first FROM user WHERE user_id='$user_id'");
		$arr= mysqli_fetch_array($fetch2);
		
		try 			/*Send email to candidate that your application has been accepted */
		{
			$mail->setFrom('proactivecba@gmail.com','Proactive Jobs');
			$mail->addAddress($arr["user_email"],$arr["user_first"]);
			$mail->addReplyTo('noreply@info.com','');

			$mail->isHTML(true);                              
			$mail->Subject = 'Status of job application.';
			$mail->Body    = '<html>
								<head>
									<link rel="stylesheet" href="/resources/demos/style.css">
								</head>
								<body>
									<div class="single-post" style="padding:30px;background-color:#cce4ff;margin-bottom: 30px;box-shadow:2px 2px 2px 0px;">
										<div align="center">
						        			<p>
									            <p style="background-color:#fff; width:50%; padding:50px; font-size:22px;
									            	margin-left:60px">
										            	Dear '.$arr["user_first"].',<br>
											            	Greetings from '.$cmp.'! We are pleased to announce that your job application for the post of '.$job_title.' has been accepted for the placement process. You will be informed shortly about details of the interviews to be held.
																<br><br>
										            				Regards,<br>'.$rec_name.'
										            </p>
										        </p>									           
						        			</p> 
						        		</div>       
					        		</div>
				    			</body>
				    		  </html>';
			$mail->send();
		}
		catch(Exception $e)
		{
			 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}


		$notif= mysqli_query($conn,"INSERT INTO notifications(sender_id,receiver_id,name,type,message,status,notif_date) VALUES('$rec_id','$user_id','$rec_name','application','Your application for job has been accepted','unread','$date')");

		/*$app = $_GET['app'];*/
		echo "<script language=\"Javascript\">\n";
		echo "window.history.back()";
		echo "</script>";
	}

	else if(isset($_GET['rej']))	/* When recruiter clicks on 'reject' */
	{

		$app2 = $_GET['rej'];
		$result =mysqli_query($conn,"UPDATE applications SET status='rejected' WHERE app_id=$app2");

		$fetch1=mysqli_query($conn,"SELECT applications.job_id,job_title,applications.recruiter_id,user_id,company,recruiter.recruiter_first,recruiter.recruiter_email FROM applications INNER JOIN recruiter ON applications.recruiter_id=recruiter.recruiter_id INNER JOIN joblist ON applications.job_id=joblist.job_id WHERE app_id=$app2");
		
		$row=mysqli_fetch_array($fetch1);

		$job_id=$row["job_id"];
		$job_title=$row["job_title"];
		$rec_id=$row["recruiter_id"];
		$user_id=$row["user_id"];
		$rec_name=$row["recruiter_first"];
		$cmp= $row["company"];

		$fetch2= mysqli_query($conn,"SELECT user_email,user_first FROM user WHERE user_id='$user_id'");
		$arr= mysqli_fetch_array($fetch2);

		try 		/*Send email to candidate that your application has been rejected */
		{
			$mail->setFrom($row["recruiter_email"],'Recruiter at Proactive Jobs');
			$mail->addAddress($arr["user_email"],$arr["user_first"]);
			$mail->addReplyTo('noreply@info.com','');

			$mail->isHTML(true);                              
			$mail->Subject = 'Status of job application.';
			$mail->Body    = '<html>
								<body>
									<div class="single-post" style="padding:30px;background-color:#cce4ff;margin-bottom: 30px;box-shadow:2px 2px 2px 0px;">
										<div align="center">
						        			<p>
									            
									            <p style="background-color:#fff; width:50%; padding:50px; font-size:22px;">
									            	Dear '.$arr["user_first"].',<br>
										            	Greetings from '.$cmp.'! We are sorry to inform you that your job application 
														for the post of '.$job_title.' has been rejected for the placement process. We do encourage you to apply for future openings for which you qualify. Wish you all the best for future opportunities and thank you for showing interest in our company.
													
																<br><br>
										            				Regards,<br>'.$rec_name.'
									            	</p>
									            </p>
						        			</p> 
						        		</div>       
					        		</div>
				    			</body>
				    		  </html>';
			$mail->send();
		}
		catch(Exception $e)
		{
			 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}		

		$result2=mysqli_query($conn,"INSERT INTO status_rejected(app_id,job_id,recruiter_id,user_id) VALUES($app2,$job_id,$rec_id,$user_id)");

		$result3=mysqli_query($conn,"INSERT INTO notifications(sender_id,receiver_id,name,type,message,status,notif_date) VALUES('$rec_id','$user_id','$rec_name','application','Your application for job has been rejected','unread','$date')");

		echo "<script language=\"Javascript\">\n";
		echo "window.history.back()";
		echo "</script>";
	}
	else
	{
		echo "<script language=\"Javascript\">\n";
		echo "window.history.back()";
		echo "</script>";
	}

	

?>