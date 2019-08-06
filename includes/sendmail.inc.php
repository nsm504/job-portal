<?php
	include 'dbh.inc.php';

  $int_date='';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require_once '../mailing/vendor/autoload.php';
  $mail= new PHPMailer(true);


  if(isset($_POST['sendmail']))
  {
    $mailTo = $_POST['mailTo'];
    $mailSub = $_POST['mailSub'];
    $message = $_POST['message'];
    $int_date= $_POST['int_date'];

    $recipient_trim=rtrim($mailTo,", ");
    $recipient_arr= explode(",",$recipient_trim);
    $headers= 'Bcc:'.$recipients.'\r\n';
    
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
        foreach($recipient_arr as $recipient)
        {
          $mail->addAddress($recipient,'');
        }
        $mail->addReplyTo('proactivecba@gmail.com', 'Information');
     
        $mail->isHTML(false);                                  // Set email format to HTML
        $mail->Subject = $mailSub;
        $mail->Body = $message;

        $mail->send();
        echo 'Message has been sent';

        echo "<p>Mail Sent</p>";
        echo "<script type='text/javascript'>";
        echo "window.location.href='../recruiter/recjob.php'";
        echo "</script>";
    } 
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


  /*  if(mail($recipients, $mailSub, $message, $headers))
    {

    }
    else
    {
       echo "<p>Mail Not Sent. Please try again later</p><p><a href='javascript:history.back()'>Go Back</a></p>";
    } */


  }
    
?>

</html> 