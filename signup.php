<?php 

	include 'nav.php';

?>
 	

		<body>


			<?php include 'header.php'; ?>

			
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content-signup col-lg-12"><br>
							<h1 class="text-white">
								<br>
								Sign Up	For Candidate	
							</h1>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start contact-page Area -->
			<p class="text-center"></p>

			<section class="section-gap-signup">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 flex-column">
						
						</div>
						<div class="col-lg-10">
							<form id="userSignup" class="form-area contact-form text-right">
								<div class="row">	
									
									<div class="col-lg-12 form-group form-signup">
									
										<b style="text-align:left;" class="dark label">First Name:&nbsp;&nbsp;</b>
										<input name="first" placeholder="Enter your First name" style="text-align:left;" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your First name'" class="padding-input common-input mb-10 form-control inputsize" required="" type="text">

										<b style="text-align:left;" class="dark label">Last Name:&nbsp;&nbsp;</b>
										<input name="last" style="text-align:left;" placeholder="Enter your Last name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Last name'" class="common-input mb-10 form-control inputsize" required="" type="text">										
										<b style="text-align:left;" class="dark label">Email Id:&nbsp;&nbsp;</b>
										<input name="email" style="text-align:left;" placeholder="Enter your email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-10 form-control inputsize" required="" type="text">

										<b style="text-align:left;" class="dark label">Phone No:&nbsp;&nbsp;</b>
										<input name="mobile" style="text-align:left;" placeholder="Enter your mobile number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your mobile number'" class="common-input mb-10 form-control inputsize" required="" type="text">

										<!--<b style="text-align:left;" class="dark label">Location:&nbsp;&nbsp;</b>
										<input type="hidden" name="country" id="countryId" value="IN"/>
										<select style="width:58%; height:6%;" name="state" class="states order-alpha form-control mb-10" id="stateId">
										    <option value="">Select State</option>
										</select>
										
										<select style="margin-left:240px;width:58%; height:6%;" name="loc" class="cities cityfix order-alpha form-control mb-10" id="cityId">
										    <option value="">Select City</option>
										</select>-->

										<b style="text-align:left;" class="dark label">Location:&nbsp;&nbsp;</b>
										  <input list="loc" name="loc" style="text-align:left;" placeholder="Enter your City" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your City'" class="common-input mb-10 form-control inputsize" required="">
										  <datalist id="loc">
										  </datalist>


										<b style="text-align:left;" class="dark label">Gender:&nbsp;&nbsp;</b>
										<select name="gender" style="width:58%; height:6%;" class="form-control mb-10">
											<option>Male</option>
											<option>Female</option>
											<option>Other</option>
										</select>
										

										<b style="text-align:left;" class="dark label ">Date Of Birth:&nbsp;&nbsp;</b><input name="dob" placeholder="Enter your Date of birth" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your date of birth'" class="common-input mb-10 form-control inputsize" required="" type="date">


										<b style="text-align:left;" class="dark label ">Username:&nbsp;&nbsp;</b>
										<input name="uid" readonly placeholder="Enter your Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Username'" class="common-input mb-10 form-control inputsize" required="" type="text">																					

										<b style="text-align:left;" class="dark label ">Password:&nbsp;&nbsp;</b><input name="pwd" placeholder="Enter your Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Password'" class="common-input mb-10 form-control inputsize" required="" type="password">

										<div align="center">
											<button type="submit" name="register" class="primary-btn text-white">Confirm</button>
										</div>
										
										<div align="center" class="alert-msg result"></div><br><br><br><br>
									</div>
								</div>
							</form>	
						</div>
					</div>
				</div>	
			</section>
			<!-- End contact-page Area -->
			
<?php

include 'footer.php';?>

<script src="js/userSignup.js"></script>
<script src="js/cities.js"></script>

<script type="text/javascript">
	$(document).on('keyup','input[name="email"]',function()
	{
		var mail= $('input[name="email"]').val();

		$('input[name="uid"]').val(mail);
	});
</script>