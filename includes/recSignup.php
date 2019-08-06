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
	$uid= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['uid']));
	$pwd= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['pwd']));
	$des= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['des']));
	$cmp= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['cmp']));
	$ind= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['ind']));
	$addr= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['addr']));
	$city= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['city']));
	$mobile= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['mobile']));
	$gst= htmlspecialchars(mysqli_real_escape_string($conn,$_POST['gst']));

	// Error handlers
	// Check for empty fields

			$sql= "SELECT * FROM recruiter WHERE recruiter_email='$email'";
			$result= mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);

			if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $resultCheck>0) 
			{
				echo '<b><b class="text-danger"><br>The Email ID you&apos;ve entered already exists. Please enter another Email.</b></b>';
			} 
			else
			{
				$sql= "SELECT * FROM recruiter WHERE recruiter_uid='$uid'";
				$result= mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if($resultCheck>0){
					echo '<b><b class="text-danger"><br>The Username you&apos;ve entered already exists. Please enter another Username.</b></b>';	
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
							$rndno=rand(100000, 999999);
							$message = urlencode("confirmation code.".$rndno);

							$sql= "INSERT INTO recruiter(recruiter_first,recruiter_last,recruiter_email,recruiter_uid,recruiter_password,recruiter_designation,company_name,industry,office_addr,city,mobileno,gst,account_status) VALUES ('$first','$last','$email','$uid','$hashedPwd','$des','$cmp','$ind','$addr','$city','$mobile','$gst','Not Confirmed')";
							mysqli_query($conn,$sql);

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

						        //Recipients
						        $mail->setFrom('proactivecba@gmail.com', 'Proactive Jobs');
						        $mail->addAddress($email);
						     
						        $mail->isHTML(false);                                  // Set email format to HTML
						        $mail->Subject = 'Code For Account Confirmation';
						        $mail->Body = 'Confirmation Code is '.$rndno.' ';

						        $mail->send();
						    } 
						    catch (Exception $e) {
						        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						    }

						    $_SESSION['otp']=$rndno;
							echo '<b><b class="text-success">Signup successful. Redirecting you to account confirmation...</b></b>';
						}
					}
				}
			}
	
}

?>