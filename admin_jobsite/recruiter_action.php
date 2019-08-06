<?php 

include '../includes/dbh.inc.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../mailing/vendor/autoload.php';
$mail= new PHPMailer(true);
$msg='';


if(isset($_POST['user_id']))
{
	$rec_id= $_POST['user_id'];

	$sql1="UPDATE recruiter SET account_status='Verified' WHERE recruiter_id='$rec_id'";
	$result1= mysqli_query($conn,$sql1);

	$sql2="SELECT recruiter_email,recruiter_first FROM recruiter WHERE recruiter_id='$rec_id'";
	$result2= mysqli_query($conn,$sql2);
	$row= mysqli_fetch_array($result2);

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
		$mail->setFrom('proactivecba@gmail.com','proactivecba');
		$mail->addAddress($row["recruiter_email"],$row["recruiter_first"]);

		$mail->isHTML(true);
		$mail->Subject='Account Verification for Proactive Jobs';
		$mail->Body='Hello '.$row["recruiter_first"].'!<br> Your account has been verified along with the required documents that you have submitted online. You are now permitted to post jobs to a large pool of candidates on our website. We welcome you to carry your recruitment through our site. We wish you the very best in your mission of providing employment to potential candidates.';

		$mail->send();

	}
	catch(Exception $e)
	{
		$msg='Mail could not be sent';
	}

}

else if(isset($_POST['deactivate']))
{
	$rec_id= $_POST['deactivate'];

	$sql1="UPDATE recruiter SET account_status='Deactivated' WHERE recruiter_id='$rec_id'";
	$result1= mysqli_query($conn,$sql1);

}

else if(isset($_POST['restore']))
{
	$rec_id= $_POST['restore'];

	$sql1="UPDATE recruiter SET account_status='Confirmed' WHERE recruiter_id='$rec_id'";
	$result1= mysqli_query($conn,$sql1);

}


 ?>
