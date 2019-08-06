<?php 
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../mailing/vendor/autoload.php';
$mail= new PHPMailer(true);

if(!empty($_POST))
{
		include_once 'dbh.inc.php';

		$first= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['first']));
		$last= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['last']));
		$email= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['email']));
		$mobile=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['mobile']));
		$loc=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['loc']));
		$dob=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['dob']));
		$uid= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['uid']));
		$gen= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['gender']));
		$pwd= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['pwd']));


		if(!preg_match("/^[a-zA-Z\\s]*$/",$first) || !preg_match("/^[a-zA-Z\\s]*$/",$last))
		{
			echo '<b><b class="text-danger">First name and Last name should only contain alphabets and not other characters</b></b>';
		} 
		else
		{
			$sql= "SELECT * FROM user WHERE user_email='$email'";
			$result= mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);

			if (/*!filter_var($email, FILTER_VALIDATE_EMAIL) ||*/ $resultCheck>0)
			{
				echo '<b><b class="text-danger">The Email ID you&apos;ve entered already exists. Please enter another Email.</b></b>';
			} 
			else
			{
				$sql= "SELECT * FROM user WHERE user_uid='$uid'";
				$result= mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if($resultCheck>0)
				{
					echo '<b><b class="text-danger">Username you&apos; entered already exists. Please enter another username.</b></b>';
				} 
				else
				{
					if(!preg_match("/^[0-9]*$/",$mobile))
					{
						echo '<b><b class="text-danger">Invalid mobile number entered.</b></b>';
					}
					else
					{
						if(strlen($mobile)!=10)
						{
							echo '<b><b class="text-danger">Mobile number should be exactly 10 digits.</b></b>';
						}				
						else
						{
							// Hashing password
							$hashedPwd= password_hash($pwd, PASSWORD_DEFAULT);
							// Insert the user into the database

							$rndno=rand(100000,999999);
							$message = urlencode("confirmation code.".$rndno);

							$sql= "INSERT INTO user(user_first,user_last,mobile,location,user_email,user_uid,dob,gender,user_password,account_status) VALUES('$first','$last','$mobile','$loc','$email','$uid','$dob','$gen','$hashedPwd','Not Confirmed')";
							$result=mysqli_query($conn,$sql);

							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							$to= $email;
							$subject= 'Code For Account Confirmation';
							$message= 'Confirmation Code is '.$rndno.' ';

							mail($to, $subject, $message, $headers);

						/*    try{
						        //Server settings
						        /*$mail->SMTPDebug = 1;                                       // Enable verbose debug output
						        $mail->isSMTP();                                            // Set mailer to use SMTP
						        $mail->Host       = 'smtp.sendgrid.net';                    // Specify main and backup SMTP servers
						        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
						        $mail->Username   = 'user@example.com';                     // SMTP username
						        $mail->Password   = 'secret';                               // SMTP password
						        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
						        $mail->Port       = 587;            */                        // TCP port to connect to

						        //Recipients
						/*      $mail->setFrom('proactivecba@gmail.com', 'Proactive Jobs');
						        $mail->addAddress($email,'');
						     
						        $mail->isHTML(false);                                  // Set email format to HTML
						        $mail->Subject = 'Code For Account Confirmation';
						        $mail->Body = 'Confirmation Code is '.$rndno.' ';

						        $mail->send();

						    } 
						    catch (Exception $e) {
						        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						    } 
						*/
							$_SESSION['otp']=$rndno;
							echo '<b><b class="text-success">Signup successful.</b></b>';
							
						}
					}
				}
			}
		}	
}


?>