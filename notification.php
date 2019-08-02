<?php 

session_start();
include 'includes/dbh.inc.php';

if(isset($_GET['id']))			/*When candidate clicks on notification bar */
{
	$notif_id=$_GET['id'];

	$query="UPDATE notifications SET status='read' WHERE notif_id='$notif_id'";
	$result=mysqli_query($conn,$query);

	echo ' <script type="text/javascript">';
	echo 'window.location.href="/job-revised/candidate/profile.php" ';
	echo '</script>';

}

if(isset($_GET['rid']))		/*When recruiter clicks on notification bar */
{
	$notif_id=$_GET['rid'];

	$query="UPDATE notifications SET status='read' WHERE notif_id='$notif_id'";
	$result=mysqli_query($conn,$query);

	$fetch_job="SELECT job_id FROM notifications WHERE notif_id='$notif_id' ";
	$result_job= mysqli_query($conn,$fetch_job);

	$row=mysqli_fetch_array($result_job);
	$job_id=$row["job_id"];
	$jid= base64_encode($job_id);

	/*echo ' <script type="text/javascript">';
	echo 'window.location.href="\\recjob2.php?id=$jid\\" ';
	echo '</script>';*/

	echo '<script type="text/javascript">';
	echo 'window.location.href="recruiter/recjob2.php?id='.$jid.'"';
	echo '</script>';
}


if(isset($_GET['del']))		/*When candidate/recruiter clicks on delete notifications */
{
	$receiver_id=$_GET['del'];
	$delete="DELETE FROM notifications WHERE receiver_id='$receiver_id'";
	$action=mysqli_query($conn,$delete);

	echo '<script type="text/javascript">';
	echo 'window.history.back();';
	echo '</script>';
}		


 ?>

