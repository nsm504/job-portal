<?php 

		include 'nav.php';
 ?>
		
<body>

 	<?php
 		include 'header.php';
 		include 'includes/dbh.inc.php';

 		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require_once 'mailing/vendor/autoload.php';		/*Load PHPMailer to send OTP via mail*/ 
		$mail= new PHPMailer(true);

		$rndno=0;

		if(isset($_POST['email']))				/*Check for email */
		{
			$email=mysqli_real_escape_string($conn,$_POST['email']);

			$sql="SELECT recruiter_email FROM recruiter WHERE recruiter_email='$email'";
			$result=mysqli_query($conn,$sql);

			if(mysqli_num_rows($result)==0)			/*Email not found */
			{
				echo 'The email ID that you have entered does not exist. Try with another email.';
			}
			else 			/* Send OTP through email*/ 
			{
				$rndno=rand(10000,99999);

				$mail->setFrom('proactivecba@gmail.com','Proactive Jobs');
				$mail->addAddress($email,'');
				$mail->addReplyTo('noreply@info.com','');

				$mail->isHTML(true);                              
				$mail->Subject = 'Request for Password change';
				$mail->Body    = 'Your OTP for setting a new password is '.$rndno.'';
				$mail->send();

				$_SESSION['mail']=$email;
				$_SESSION['code']=$rndno;
			}
		}

		if(isset($_SESSION['code']) && isset($_SESSION['mail'])) /*Check if session variables are active */
		{
			$session_code=$_SESSION['code'];
			$session_mail=$_SESSION['mail'];

			if(isset($_POST['code']))
			{
				$code=mysqli_real_escape_string($conn,$_POST['code']);

				if(!strccmp($session_code,$code))
				{
					echo 'OTP is correct';
				}
				else
				{
					echo 'OTP entered is incorrect.';
				}
			}

			else if(isset($_POST['pwd']))
			{
				$pwd= mysqli_real_escape_string($conn,$_POST['pwd']);

				$hashedPwd= password_hash($pwd,PASSWORD_DEFAULT);

				$sql= "UPDATE recruiter SET recruiter_password='$hashedPwd' WHERE recruiter_email='$session_mail'";
				mysqli_query($conn,$sql);

				$mail->setFrom('proactivecba@gmail.com','Proactive Jobs');
				$mail->addAddress($session_mail,'');
				$mail->addReplyTo('noreply@info.com','');

				$mail->isHTML(true);                              
				$mail->Subject = 'Change of Password';
				$mail->Body    = 'The password for your account has been successfully changed.';
				$mail->send();
			}
		}

 	?>	

	<section class="banner-area relative" id="home">	
		<div class="overlay overlay-bg"></div>
			<div class="container">
				<div class="row d-flex align-items-center justify-content-center">
					<div class="about-content-signup col-lg-12"><br>
						<h1 class="text-white">
						<br>
							Change password	
						</h1>
					</div>											
				</div>
			</div>
	</section>

	<section class="section-gap-signup mb-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 d-flex flex-column"></div>
					<div class="col-lg-10">
						<div class="row">	
							<div class="col-lg-12 form-group">	

								<div id="mail">
									<b class="dark label">Enter registered Email Id:</b><input id="email" name="email" placeholder="Enter your email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-10 form-control inputsize1" required="" type="text">
								</div>		
								<p id="result"></p>

								<div hidden id="otp">
									<b class="dark label">Verification Code:</b><input id="code" name="code" placeholder="Enter Confirmation code" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Confirmation code'" class="common-input mb-10 form-control inputsize1" required="" type="text">
								</div>
								<p id="result"></p>

								<div hidden id="pass">
									<b class="dark label">Enter new password:</b><input id="pwd" name="pwd" placeholder="Enter Confirmation code" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Confirmation code'" class="common-input mb-10 form-control inputsize1" required="" type="password">
								</div>
								<p id="result"></p>

								<button id="btn-send" style="margin-left:40%;" align="center" type="submit" name="sendcode" class="mt-20 ">Confirm account</button>

								<button hidden id="btn-verify" style="margin-left:40%;" align="center" type="submit" name="sendcode" class="mt-20 ">Confirm OTP</button>

								<button hidden id="btn-change" style="margin-left:40%;" align="center" type="submit" name="sendcode" class="mt-20">Change password</button>

								<div class="alert-msg" style="text-align: center;"></div>
							</div>
						</div>
					</div>
			</div>
		</div>	
	</section><br>
			
			<!-- End contact-page Area -->			
<?php 
	include 'footer.php';
?>
 
<script type="text/javascript" src="js/changePwd.js"></script>

