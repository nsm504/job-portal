<?php 

		include 'nav.php';
 		include 'header.php';

		include 'includes/dbh.inc.php';

		if(isset($_POST['email']))
		{
			$email=mysqli_real_escape_string($conn,$_POST['email']);
			$rndno=rand(10000,99999);

			$fetch_mail="SELECT user_email FROM users WHERE user_email='$email'";
			$res_mail=mysqli_query($conn,$fetch_mail);

			if(mysqli_num_rows($res_mail)==0)
			{
				echo 'The email you have entered does not exist. Please enter another email.';
			}
			else
			{
				$to=$email;
				$subject = 'Request for Password change';
				$txt = 'Your OTP for setting a new password is'.$rndno.'';

				mail($to,$subject,$txt); 

				$_SESSION['code']=$rndno;

				echo '<script type="text/javascript>';
				echo 'window.location.href="changepwd2.php"';
				echo '</script>';
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
			<!-- End banner Area -->	

			<!-- Start contact-page Area -->
			<section class="section-gap-signup mb-5">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 d-flex flex-column">
						
						</div>
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

										<div class="alert-msg" style="text-align: left;"></div>
										<p></p>
									</div>
								</div>
						</div>
					</div>
				</div>	
			</section>
			
			<!-- End contact-page Area -->			
<?php 

	include 'footer.php';
 ?>


