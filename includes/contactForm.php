<?php 

include 'dbh.inc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../mailing/vendor/autoload.php';
$mail= new PHPMailer(true);


if(!empty($_POST))
{
	$contact_name= mysqli_real_escape_string($conn,$_POST['contact_name']);
	$email= mysqli_real_escape_string($conn,$_POST['email']);
	$mobile= mysqli_real_escape_string($conn,$_POST['mobile']);
	$location= mysqli_real_escape_string($conn,$_POST['location']);
	$message= mysqli_real_escape_string($conn,$_POST['message']);

}


 ?>