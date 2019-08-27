
<?php 

		include 'nav.php';
 ?>

<body>
	<header style="background-color:white; color:black;" id="header" id="home">
		<div class="container">
			<div class="row align-items-center justify-content-between d-flex">
				<div id="logo">
				    <a href="index.php"><img class="logo-header" src="img/logo-new.png" alt="" title="" /></a>
				</div>

				<nav style="margin-right:50px;" id="nav-menu-container">
				    <ul class="nav-menu">
				        <li class="menu-active"><a href="index.php">Home</a></li>
	                   	<li><a href="category.php">Category</a></li>
					    <li><a href="price.php">Pricing</a></li>
					    <li class="menu-has-children"><a style="color:black; cursor:pointer;">Recruiter</a>
							<ul>
								<li>
									<a data-toggle="modal" data-target="#modalSignupRec"  href="#">
										<b class="dark">Signup</b>
									</a>
								</li>
								<li>
									<a data-toggle="modal" data-target="#modalLoginRec" class="" href="#">
										<b class="dark">Login</b>
									</a>
								</li>
						    </ul>
						</li>

					    <li>
					      	<a data-toggle="modal" data-target="#modalLogin"class="ticker-btn" href="#">Login</a>
					    </li>
					</ul>
				</nav><!-- #nav-menu-container -->		    		
			</div>
		</div>
	</header>

			<!-- start banner Area -->
	<section class="banner-area relative" id="home">	
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content-signup col-lg-12"><br>
					<h1 class="text-white">
						<br>
						Confirm Your Account	
					</h1>
				</div>											
			</div>
		</div>
	</section>
			<!-- End banner Area -->	

			<!-- Start contact-page Area -->
	<section class="section-gap-signup">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 d-flex flex-column"></div>
				<div class="col-lg-10">
					<form class="form-area" id="formConfirmRec" class="contact-form text-right">
						<div class="row">	
							<div class="col-lg-12 form-group" >										
										
								<!--<b class="dark label">Mobile number: </b> <input type="text" name="mobile" placeholder="Enter your mobile number" onfocus="this.placeholder = ''" onblur="this.placeholder='Enter your mobile number'" class="common-input mb-10 form-control inputsize1" required="" type="text">-->

								<b class="dark label">Email Id: </b><input name="email" placeholder="Enter your email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-10 form-control inputsize1" required="" type="text">
											

								<b class="dark label">Confirmation Code:</b><input name="code" placeholder="Enter Confirmation code" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Confirmation code'" class="common-input mb-10 form-control inputsize1" required="" type="text">

								<button style="margin-left:40%;" align="center" type="submit" name="" class="primary-btn mt-20 text-white">Verify OTP</button>
										
								<div class="sending"></div>

							</div>

							<div class="alert-msg" style="text-align: left;"></div>

						</div>
					</form>	
				</div>
			</div>
		</div>	
	</section>

	<br><br>
			<!-- End contact-page Area -->
<?php 
include 'footer.php';
?>

<script src="js/confirmRec.js"></script>
