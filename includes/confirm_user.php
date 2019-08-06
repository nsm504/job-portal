<?php 
session_start();
include 'dbh.inc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../mailing/vendor/autoload.php';
$mail= new PHPMailer(true);

$msg='';

if(isset($_SESSION['otp']))
{
	$rno= $_SESSION['otp'];

	if(!empty($_POST))
	{
		$urno=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['code']));
		$email=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['email']));
		
		if(!strcmp($rno,$urno))
		{
			$fetch_id="SELECT user_id,user_first,user_last FROM user WHERE user_email='$email'";
			$res=mysqli_query($conn,$fetch_id);

			$row=mysqli_fetch_assoc($res);
			$userId= $row["user_id"];

			$_SESSION['userId']=$userId;
				//$mail=$_SESSION['email'];
				//For admin if he want to know who is register
			try{

				/*$mail->SMTPDebug= 1;
				$mail->isSMTP();
				$mail->Host = ;
				$mail->SMTPAuth = true;
				$mail->Username = ;
				$mail->Password = ;
				$mail->SMTPSecure= ;
				$mail->Port= ; */

				$mail->setFrom('proactivecba@gmail.com','Proactive Jobs');
				$mail->addAddress($email,$row["user_first"].' '.$row["user_last"]);
				$mail->addReplyTo('proactivecba@gmail.com','Proactive Jobs');

				$mail->isHTML(true);                              
			    $mail->Subject = 'Your account has been activated';
			    $mail->Body = ' <!DOCTYPE html>
								<html>
								<body>
									<div>
										<div style="padding:30px;background-color:#cce4ff;margin-bottom: 30px;box-shadow:2px 2px 2px 0px;">
											<div align="center"> 
												<p style="background-color:#fff; width:50%; padding:50px; font-size:22px;">Your account for Proactive Jobs has been activated.</p>
												<p style="margin-top:2px;">
								                    Copyright &copy;Proactive '.date('Y').' All right reserved. By <a href="http://www.cbaindia.in/" target="_blank"> Proactive CBA</a>
								                </p>
											</div>
										</div>
									</div>
								</body>
								</html>';

			    $mail->send();

			    echo '<p class="mb-5"><b class="dark">Your account has been confirmed. To start using your account, you need to verify our identity with the following documents:<br><br>
			    	1.10th,12th marksheet<br>
			    	2.University Passing certificate/Final semester marksheet<br>
			    	3.Aadhar Card.<br></b>
						<a href="details.php" style="" align="center" class="primary-btn mt-20 text-white">Click to fill in your educational details.
						</a></p>
						<br>';

			}
			catch(Exception $e){
				echo 'Email could not be sent. Mailer Error: {$mail->ErrorInfo}';
			}

				//For admin if he want to know who is register
			$update= "UPDATE user SET account_status='Confirmed' WHERE account_status='Not Confirmed' AND user_email='$email'";
			mysqli_query($conn,$update);
		}
		else
		{
			echo '<p>Invalid OTP</p><br><br><br><br>';
		}
	}
}
else
{
	echo '<p class="dark">Invalid OTP</p><br><br><br><br>';	
}

?>


