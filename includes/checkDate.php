<?php 

include 'dbh.inc.php';
$date= date('Y-m-d');

if(isset($_POST['checkDate']))
{
	$sql="SELECT last_date,job_status,job_id FROM joblist";
	$result= mysqli_query($conn,$sql);

	while($row=mysqli_fetch_array($result))
	{
		$job_id=$row["job_id"];
		if(strtotime($row["last_date"])<strtotime($date))
		{
			$del="UPDATE joblist SET job_status='inactive' WHERE job_id='$job_id'";
			mysqli_query($conn,$del);
		}
		else
		{
			$del="UPDATE joblist SET job_status='active' WHERE job_id='$job_id'";
			mysqli_query($conn,$del);			
		}
	}
}



?>