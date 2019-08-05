<?php 

include '../includes/dbh.inc.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../mailing/vendor/autoload.php';
$mail= new PHPMailer(true);
$msg='';


if(isset($_POST['user_id']))
{
	$user_id= $_POST['user_id'];

	$sql1="UPDATE user SET account_status='Verified' WHERE user_id='$user_id'";
	$result1= mysqli_query($conn,$sql1);

	$sql2="SELECT user_email,user_first FROM user WHERE user_id='$user_id'";
	$result2= mysqli_query($conn,$sql2);
	$row= mysqli_fetch_array($result2);

	try{

		$mail->setFrom('proactivecba@gmail.com','proactivecba');
		$mail->addAddress($row["user_email"],$row["user_first"]);

		$mail->isHTML(true);
		$mail->Subject='Account Verification for Proactive Jobs';
		$mail->Body='Hello '.$row["user_first"].'!<br> Your account has been verified along with the required documents that you have submitted online. We welcome you to start applying for the thousands of jobs that are available on our website. We wish you all the best in your quest for enhancing your career prospects.';

		$mail->send();

	}
	catch(Exception $e)
	{
		$msg='Mail could not be sent';
	}

}

else if(isset($_POST['deactivate']))
{
	$user_id= $_POST['deactivate'];

	$sql1="UPDATE user SET account_status='Deactivated' WHERE user_id='$user_id'";
	$result1= mysqli_query($conn,$sql1);

}

else if(isset($_POST['restore']))
{
	$user_id= $_POST['restore'];

	$sql1="UPDATE user SET account_status='Confirmed' WHERE user_id='$user_id'";
	$result1= mysqli_query($conn,$sql1);

}


 ?>