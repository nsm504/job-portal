<?php 

	/*$rndno= rand(1000,9999);

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	$to= 'nimjz05@gmail.com';
	$subject= 'Testing here...';
	$message= 'Confirmation Code is '.$rndno.' ';

	mail($to, $subject, $message, $headers);*/


	$to_email = 'nirmalmenon97@gmail.com';
	$subject = 'Testing PHP Mail';
	$message = 'This mail is sent using the PHP mail function';
	$headers = 'From: noreply @ company . com';
	mail($to_email,$subject,$message,$headers);


 ?>