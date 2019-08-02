<body>
	<?php 
		include 'nav.php';
		include 'header.php'; 
		$uid=$_SESSION['userId'];

	?>

	<section class="banner-area relative" id="home">	
		<div class="overlay overlay-bg"></div>
			<div class="container">
				<div class="row d-flex align-items-center justify-content-center">
					<div class="about-content-signup col-lg-12">
						<h1 class="text-white">
						<br>
							Academic Details		
						</h1>
					</div>											
				</div>
			</div>
	</section>

	<section class="section-gap-signup">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 d-flex flex-column"></div>

				<div class="col-lg-8">
					<form class="form-area " action="includes/signup.inc.php" method="post" class="contact-form">
						<div class="row">	
							<div class="col-lg-12 form-group">
							<br>
								<div style="border-top:1px solid #ccc;">
								<br>
									<b class="dark label">Qualification</b>
									<select id="grad_option" class="form-control inputsize" type="text" name="hq"><option disabled selected>Select highest qualification</option><option>Graduate</option><option>Post-Graduate</option><option>Undergraduate</option><option>Completed 12th</option></select><br><br>
								</div>

								<div hidden id="pg" style="border-top:1px solid #ccc;"><br>
									<b class="dark label">PG Course</b>
									<select id="pg_option" class="form-control inputsize" type="text" name="pgcourse">
										<option disabled selected>Select Post-graduate course</option><option>CA</option><option>CS</option><option>DM</option><option>Integrated PG</option><option>LLM</option><option>MA</option><option>M.Arch</option><option>M.Ch</option><option>M.Com</option><option>M.Des</option><option>M.Ed</option><option>M.Pharma</option><option>MDS</option><option>MFA</option><option>MS</option><option>M.Sc</option><option>M.Tech</option><option>MBA</option><option>PGDM</option><option>MCA</option><option>Medical-MS/MD</option><option>PG Diploma</option><option>MVSC</option><option>MCM</option><option>Other</option>
									</select><br>
								</div>

								<script type="text/javascript">
								
									$('#grad_option').change(function()
									{
										if($('#grad_option option:selected').text()=="Post-Graduate")
										{
											$('#pg').removeAttr('hidden');
										}
										else
										{
											$('#pg').attr('hidden','true');
										}

										if($('#grad_option option:selected').text()=="Completed 12th")
										{
											$('#spec').val('N/A');
											$('#uni').val('N/A');
											$('#pyear').val('');
											$('#perc').val('');
										}
										else
										{
											$('#spec').val('');
											$('#uni').val('');
											$('#pyear').val('');
											$('#perc').val('');
										}

									});
											
								</script>

								<div style="border-top:1px solid #ccc;">
									<br>
									<b class="dark label">Course</b>
									<select id="course" class="form-control inputsize" type="text" name="course"><option selected>Select Undergraduate course</option><option>B.E</option><option>B.tech</option><option>B.Sc</option><option>BCA</option><option>BA</option><option>B.Arch</option><option>B.Des</option><option>BP.Ed</option><option>BEL.Ed</option><option>BAMS</option><option>BUMS</option><option>BBA/BMS</option><option>BCom</option><option>B.Ed</option><option>BDS</option><option>BFA</option><option>BHM</option><option>B.Pharma</option><option>BHMS</option><option>LLB</option><option>MBBS</option><option>Diploma</option><option>BVSC</option><option>Others</option></select><br>

									<b class="dark label">Specialization</b>
									<input id="spec" class="form-control inputsize "  style="text-align:left;" type="text" name="spec" ><br>

									<b class="dark label">University</b>
									<input id="uni" class="form-control inputsize "  style="text-align:left;" type="text" name="uni" ><br>

									<b class="dark label">Year Of Passing</b>
									<input id="pyear" class="form-control inputsize "  style="text-align:left;" type="text" name="pyear" ><br>

									<b class="dark label">Percentage</b>
									<input id="perc" class="form-control inputsize"  style="text-align:left;" type="text" name="perc" ><br>
								</div><br>

								<div style="border-top:1px solid #ccc;">
									<br>
									<b class="dark label">HSC Board</b>
									<input id="" class="form-control inputsize"  style="text-align:left;" type="text" name="hboard" ><br>

									<b class="dark label">Year of Passing</b>
									<input id="" class="form-control inputsize"  style="text-align:left;" type="text" name="hyear" ><br>

									<b class="dark label">12th Percentage</b>
									<input id="" class="form-control inputsize"  style="text-align:left;" type="text" name="hperc"><br>
								</div><br>

								<div style="border-top:1px solid #ccc;">
									<br>
									<b class="dark label">SSC Board</b>
									<input class="form-control inputsize"  style="text-align:left;" type="text" name="sboard" ><br>

									<b class="dark label">Year of Passing</b>
									<input class="form-control inputsize"  style="text-align:left;" type="text" name="syear" ><br>

									<b class="dark label">10th Percentage</b>
									<input class="form-control inputsize"  style="text-align:left;" type="text" name="sperc" ><br>
								</div><br>

								<input type="hidden" name="uid" value="<?php echo $uid;?>">

								<div>
									<button class="btn-basic btn-align " type="submit" name="submit">Submit</button>
								</div><br><br><br>
								
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>	
	</section>

<?php

include 'footer.php';

?>


