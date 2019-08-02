<?php 
include 'nav.php';
 ?>
<body>

<?php 
include 'header.php';
 ?>

			<!-- start banner Area -->
	<section class="banner-area relative" id="home">	
		<div class="overlay overlay-bg"></div>
			<div class=" align-items-center ">
				<div class="about-content-signup col-lg-12">
					<h1 class="text-white">
						<br>
						Contact		
					</h1>	
				</div>											
			</div>	
	</section>
			<!-- End banner Area -->	

			<!-- Start contact-page Area -->
	<section class="contact-page-area section-gap-signup mb-3">
		<div class="container">
			<h3 align="center">Send us a message</h3><br>
			<div class="row">						
				<div class="col-lg-4 d-flex flex-column"></div>
				<div class="col-lg-8">
					<form class="form-area" id="myForm" class="contact-form text-right">
						<div class="row">	
							<div class="col-lg-12 form-group form-signup">
								<input name="contact_name" placeholder="Enter your Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Name'" class="common-input mb-20 form-control inputsize" required="" type="text">

								<input name="email" placeholder="Enter Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email Address'" class="common-input mb-20 form-control inputsize" required="" type="text">

								<input name="mobile" placeholder="Enter Mobile Number"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Mobile Number'" class="common-input mb-20 form-control inputsize" required="" type="text">

								<input name="location" placeholder="Enter Location"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Location'" class="common-input mb-20 form-control inputsize" required="" type="text">

								<textarea name="message" placeholder="Enter Message"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" class="common-input mb-20 form-control inputsize" required=""></textarea>

								<button type="submit" class="btn btn-primary" value="Submit">Submit</button>
									
														
								<div class="mt-20 alert-msg" style="text-align: left;"></div>
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>	
	</section>
			<!-- End contact-page Area -->
			
<?php 

include 'footer.php';

 ?>



