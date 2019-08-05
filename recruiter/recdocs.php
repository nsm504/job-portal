<?php 

	include 'nav.php';
 ?>
<body>
<?php 

	include 'header.php'; 

	$msg='';
	$rid=$_SESSION['recId'];

?>

	<section class="banner-area relative" id="home">	
		<div class="overlay overlay-bg"></div>
			<div class="container">
				<div class="row d-flex align-items-center justify-content-center">
					<div class="about-content-signup col-lg-12">
						<h1 class="text-white">
						<br>
							Sign Up		
						</h1>
					</div>											
				</div>
			</div>
	</section>

	<section class="section-gap-signup">
		<div class="container">
			<div>
			<div class="row">
				<div class="col-lg-4 sidebar">
					<div class="single-slidebar">
					<h4 class="text-dark">Instructions For Uploading documents</h4>
					<div>
						<p><b class="text-dark">1. All documents to be uploaded in either .pdf,.doc,.docx or .rtf format only.</b></p>
						<p><b class="text-dark">2. Documents must be within the size range of 2KB to 50KB.</b></p>
						<p><b class="text-dark">3. Once all documents are uploaded, you can click finish to successfully complete registration.</b></p>
					</div>
				</div>
			</div>


			<div class="col-lg-8 px-2 dark">
										
				<b class="dark label">Upload GST Registration Certificate</b><br>
				<input type="file" name="gst" id="gst" class="filealign text-center center-block file-upload">
				<span id="span-1"></span><br><br><strong>OR</strong><br>
							
				<b class="dark label">Upload Shop Act Certificate</b><br>
				<input type="file" name="shopact" id="shopact" class="filealign text-center center-block file-upload">
				<span id="span-2"></span><br><strong>OR</strong><br>

				<b class="dark label">Upload MSME Registration Certificate</b><br>
				<input type="file" name="msme" id="msme" class="filealign text-center center-block file-upload">
				<span id="span-3"></span><br><br><strong>OR</strong><br>

				<b class="dark label">Upload SSI Registration marksheet</b><br>
				<input type="file" name="ssi" id="ssi" class="filealign text-center center-block file-upload">
				<span id="span-4"></span><br><br><strong>OR</strong><br>

				<b class="dark label">Upload Bank statement</b><br>
				<input type="file" name="bank" id="bank" class="filealign text-center center-block file-upload">
				<span id="span-5"></span><br><br>

				<div class="" style="margin-left:140px; margin-top:20px;">
					<input type="button" class="btn btn-success" name="" value="Finish">
					<span class="finish"></span>
				</div>		


							
			</div><br><br>	
			
		</div>
	</section><br><br><br><br>

<?php

include 'footer.php';

?>

<script type="text/javascript" src="../js/recDocs.js"></script>


