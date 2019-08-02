	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="codepixer">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Proactive Jobs</title>
		<link rel="icon" type="image/png" href="img/picon.png">
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">					
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/main.css">

			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		</head>
<?php 


include 'header.php';


if(!isset($_SESSION['u_id'])) 	/*Check if candidate is logged in, if false then display error*/
{
	$jid=$_GET['jid'];
	header("Location: viewjob.php?id=$jid&job=notsaved");
}
else
{
	$SESSION=$_SESSION['u_id'];
	include 'includes/dbh.inc.php';

	$job=$_GET['jid'];
	$jid=base64_decode($_GET['jid']);
	$rid=base64_decode($_GET['rid']);

		$query="INSERT INTO saved_jobs(job_id,user_id,recruiter_id) VALUES('$jid','$SESSION','$rid')";

		$query_output=mysqli_query($conn,$query);

		header("Location: viewjob.php?id=$job&job=savedone");	/*Display success message*/
}
 ?>