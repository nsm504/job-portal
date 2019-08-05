<?php 

if(!isset($_GET['uid']))
{
	header("Location: index.php");
}
else
{
	$uid= $_GET['uid'];

	include 'header.php';
	include 'nav.php';
	include '../includes/dbh.inc.php';

	$sql="SELECT * FROM details WHERE user_id='$uid'";
	$result=mysqli_query($conn,$sql);

	$row=mysqli_fetch_array($result);

	$query="SELECT * FROM user_docs WHERE user_id='$uid'";
	$data=mysqli_query($conn,$query);
 ?>

<div align="center" class="mt-4">
	<h3>Candidate Details</h3>
</div>

<section class="mt-5">
 	<div class="container">
 		<div class="row">
 			<div class="col-lg-7">
 				<div class="table-responsive-sm">
 					<table class="table table-bordered">
 						<tr>
 							<td width="40%"><b><b class="text-dark">Highest qualification</b></b></td>
 							<td width="40%"><b class="text-dark"><?php echo $row["highest_qualification"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">UG Course</b></b></td>
 							<td><b class="text-dark"><?php echo $row["highest_qualification"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">PG Course</b></b></td>
 							<td><b class="text-dark"><?php echo $row["course"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">Specialization</b></b></td>
 							<td><b class="text-dark"><?php echo $row["pg_course"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">University</b></b></td>
 							<td><b class="text-dark"><?php echo $row["university"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">Passing Year</b></b></td>
 							<td><b class="text-dark"><?php echo $row["passing_year"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">Percentage</b></b></td>
 							<td><b class="text-dark"><?php echo $row["percentage"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">HSC Percentage</b></b></td>
 							<td><b class="text-dark"><?php echo $row["hsc_percentage"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">HSC Board</b></b></td>
 							<td><b class="text-dark"><?php echo $row["hsc_board"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">HSC Passing Year</b></b></td>
 							<td><b class="text-dark"><?php echo $row["hsc_year"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">SSC Percentage</b></b></td>
 							<td><b class="text-dark"><?php echo $row["ssc_percentage"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">SSC Board</b></b></td>
 							<td><b class="text-dark"><?php echo $row["ssc_board"]; ?></b></td>
 						</tr>
 						<tr>
 							<td><b><b class="text-dark">SSC Year</b></b></td>
 							<td><b class="text-dark"><?php echo $row["ssc_year"]; ?></b></td>
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
 						 		<td width="70%"><?php echo '<a href="../documents/candidate/'.$doc.'/'.$name.'" target="_blank">'.$disp["name"].'</a>  ' ?></td>
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