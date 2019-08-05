<?php 

include '../includes/dbh.inc.php';
$page=0;
$page1=0;

if(isset($_GET['pg']))
{
    $page=$_GET['pg'];
}
else
{
    $page=1;
}

$page1= ($page-1)*5;

if($clause=='job')
{
	$sql="SELECT job_id,job_title,time,company,location,job_type,salary,experience,recruiter_first,recruiter_last FROM $table INNER JOIN recruiter ON joblist.recruiter_id= recruiter.recruiter_id ORDER BY $id DESC LIMIT $page1,5";
	$result=mysqli_query($conn,$sql);
}
else if($clause=='app')
{
	$sql="SELECT app_id,joblist.job_title,app_date,joblist.company,user.user_first,user.user_last,status FROM $table INNER JOIN joblist ON applications.job_id= joblist.job_id INNER JOIN user ON applications.user_id= user.user_id ORDER BY $id DESC LIMIT $page1,5";
	$result=mysqli_query($conn,$sql);

}
else
{
	$sql="SELECT * FROM $table ORDER BY $id DESC LIMIT $page1,5";
	$result=mysqli_query($conn,$sql);
}

?>