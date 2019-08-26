<?php 

if(!isset($_GET['rid']))
{
	header("Location: index.php");
}
else
{
	$rid= $_GET['rid'];

	include 'header.php';
	include 'nav.php';
	include '../includes/dbh.inc.php';

	$sql="SELECT recruiter_designation,company_name,industry,office_addr,city,mobileno,gst FROM recruiter WHERE recruiter_id='$rid'";
	$result=mysqli_query($conn,$sql);

	$row=mysqli_fetch_array($result);

	$query="SELECT * FROM recruiter_docs WHERE recruiter_id='$rid'";
	$data=mysqli_query($conn,$query);
 ?>

<div align="center" class="mt-4">
	<h3>Recruiter Details</h3>
</div>

<section class="mt-5">
 	<div class="container">
 		<div class="row">
 			<div class="col-lg-7">
 				<div class="table-responsive-sm">
 					<table class="table table-bordered">
 						<tr>
 							<td width="40%"><b><b class="text-dark">Designation</b></b></td>
 							<td width="40%"><b class="text-dark"><?php echo $row["recruiter_designation"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">Company</b></b></td>
 							<td><b class="text-dark"><?php echo $row["company_name"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">Industry</b></b></td>
 							<td><b class="text-dark"><?php echo $row["industry"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">Office Address</b></b></td>
 							<td><b class="text-dark"><?php echo $row["office_addr"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">City</b></b></td>
 							<td><b class="text-dark"><?php echo $row["city"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">Mobile number</b></b></td>
 							<td><b class="text-dark"><?php echo $row["mobileno"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">GST(Y/N)</b></b></td>
 							<td><b class="text-dark"><?php echo $row["gst"]; ?></b></td>
 						</tr>
 					</table>
 				</div>
 			</div>

 			<div class="col-md-5">
 				<div class="table-responsive-sm">
 					<table class="table table-bordered" style="width:350px;">
 						<?php 
 							while($disp=mysqli_fetch_array($data))
 							{
 								$doc= $disp["document_type"];
 								$name= $disp["name"];
 						?>
 						 	<tr>
 						 		<td width="50%"><b><b class="text-dark"><?php echo $doc; ?></b></b></td>
 						 		<td width="70%"><?php echo '<a href="../documents/recruiter/'.$doc.'/'.$name.'" target="_blank">'.$disp["name"].'</a>  ' ?></td>
 						 	</tr>
 						<?php 
 							}
 						 ?>
 					</table>
 				</div>
 			</div>

 		</div> 
 	</div>
</section>

<?php

}

?>