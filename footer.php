			<!-- start footer Area -->		
<footer class="footer-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-3  col-md-12">
				<div class="single-footer-widget mb-3">
					<h6>Proactive Jobs</h6>
						<ul class="footer-nav">
							<li><a href="about_us.php">About Us</a></li>
							<li><a href="contact_us.php">Contact Us</a></li>
							<li><a href="#">Careers</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-6  col-md-12">
					<div class="single-footer-widget newsletter">
						<div id="mc_embed_signup">
							 <h2 class="ftco-heading-2 light">Contact Info</h2>
                <div class="block-23 mb-3">
                  <ul>
                    <li><span class="lnr-location"></span><span class="text">3, Basement, Mahavir Arcade,
                      Opp. Ghantali Devi Temple,<br>
                      Naupada, Thane (West) 400603.
                      Maharashtra.</span></li>
                    <li><a href="tel:02225441369"><span class="lnr-phone-handset"></span><span class="text"> (022)-66739728 / 25441369 </span></a></li>
                    <li><a href="tel:+918879808222"><span class="lnr-phone"></span><span class="text"> Whatsapp :+91 8879808222 </span></a></li>
                    <li><a href="mailto:proactivecba@gmail.com"><span class="lnr-envelope"></span><span class="text">proactivecba@gmail.com </span></a></li>
                    <li><a href="mailto:support@cbaindia.in"><span class="lnr-envelope"></span><span class="text">support@cbaindia.in</span></a></li>
                  </ul>
                </div>
                <p class="mt-2">
                  Copyright &copy;Proactive <script>document.write(new Date().getFullYear());</script>  All right reserved. By <a href="http://www.cbaindia.in/" target="_blank"> Proactive CBA</a>
                </p>                  
							</div>		
						</div>
					</div>		
				</div>

				<!--<div class="row footer-bottom justify-content-between">
					     <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">

					     </p>
					     <div class="col-lg-4 col-sm-12 footer-social">

					     </div>
				    </div>
			</div>-->
    </div>
  </div>
    <br>
</footer>
			<!-- End footer Area -->	

			<!-- Modal Login -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"><h3>Candidate Login</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="userLogin">
          <div class="form-group">              		
            <input type="text" required class="form-control" id="appointment_email" name="uid" placeholder="Username/Email">
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                 <input type="password" required class="form-control" id="appointment_time" name="pwd" placeholder="Password">
              </div>
            </div>
          </div>

          <div class="form-group">
            <input type="submit" name="submit" value="Login" class="btn btn-primary btn-outline-primary">
            <span class="response ml-3"></span>
          </div>
          
          <div class="form-group">
            <a href="changepwd.php">Forgot password ?</a>
          </div>   
        </form>
      </div> 
    </div>
  </div>
</div>

  
<div class="modal fade" id="modalSignupRec" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"><h3>Recruiter Sign Up</h3> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body"> 
        <form id="recSignup">
          <div class="form-group">
            <input type="text" required class="form-control" id="rec_first" name="first" placeholder="First Name">
          </div>

          <div class="form-group">
            <input type="text" required class="form-control" id="rec_last" name="last" placeholder="Last Name">
          </div>

          <div class="form-group">
            <input type="text" required class="form-control" id="rec_email" name="email" placeholder="Email">
          </div>

          <div class="form-group">
            <input type="text" readonly required class="form-control" id="rec_uname" name="uid" placeholder="Username">
          </div>
			
			    <div class="form-group">
            <input type="password" required class="form-control" id="rec_pwd" name="pwd" placeholder="Password">
          </div>

          <div class="form-group">
            <input type="text" required class="form-control" id="des" name="des" placeholder="Designation">
          </div>

          <div class="form-group">
            <input type="text" required class="form-control" id="cmp" name="cmp" placeholder="Company Name">
          </div>

          <div class="form-group">
            <select type="text" required class="form-control" id="ind" name="ind" placeholder="Industry">
              <option>Select type of Industry</option>
            </select>
          </div>

          <div class="form-group">
            <input type="text" required class="form-control" id="addr" name="addr" placeholder="Office Address">
          </div>

          <div class="form-group">
            <input type="text" required class="form-control" id="city" name="city" placeholder="City">
          </div>

          <div class="form-group">
            <input type="text" required class="form-control" id="rec_mobile" name="mobile" placeholder="Contact number">
          </div>

          <div class="form-group">
            <input type="text" required class="form-control" id="gst" name="gst" placeholder="GST(Y/N)">
          </div>

          <div class="form-group">   
          </div>

          <div class="form-group">
            <input type="submit" name="recsubmit" value="Register" class="btn btn-primary btn-outline-primary">
            <span class="rec-result ml-3"></span>
          </div>
        </form>
      </div>       
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).on('keyup','input[name="email"]',function()
  {
    var mail= $('input[name="email"]').val();

    $('input[name="uid"]').val(mail);
  });
</script>


<div class="modal fade" id="modalLoginRec" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"><h3>Recruiter Login</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="recLogin">
          <div class="form-group">
              <input type="text" required class="form-control" name="uid" placeholder="Username/Email">
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="password" required class="form-control" name="pwd" placeholder="Password">
              </div>
            </div>
          </div>
            
          <div class="form-group">  
          </div>

          <div class="form-group">
            <input type="submit" name="recsubmit" value="Login" class="btn btn-primary btn-outline-primary">
            <span class="response-2 ml-3"></span>
          </div>

          <div class="form-group">
            <a href="changepwdrec.php">Forgot password ?</a>
          </div>

        </form>
      </div> 
    </div>
  </div>
</div>


<script src="js/checkDate.js"></script>
<script src="js/contactForm.js"></script>
<script src="js/userSignup.js"></script> 
<script src="js/recSignup.js"></script>
<script src="js/userLogin.js"></script>
<script src="js/recLogin.js"></script>
<script src="js/jobCategory.js"></script>
<script src="js/jobUpdate.js"></script>
<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>			
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<script src="js/easing.min.js"></script>			
<script src="js/hoverIntent.js"></script>
<script src="js/superfish.min.js"></script>	
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>	
<script src="js/owl.carousel.min.js"></script>			
<script src="js/jquery.sticky.js"></script>
<script src="js/jquery.nice-select.min.js"></script>			
<script src="js/parallax.min.js"></script>		
<script src="js/mail-script.js"></script>	
<script src="js/main.js"></script>	

	</body>
</html>