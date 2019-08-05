<?php 

$table='joblist';
$id='job_id';
$clause='';

include 'data.php';
$output = '';

if(isset($_POST["job"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["job"]);
 $query = "
  SELECT job_id,job_title,time,company,location,job_type,salary,experience,recruiter_first,recruiter_last FROM joblist INNER JOIN recruiter ON joblist.recruiter_id= recruiter.recruiter_id WHERE recruiter_first LIKE '%$search%' OR job_title LIKE '%$search%' OR company LIKE '%$search%' OR location LIKE '%$search%' OR job_type LIKE '%$search%' OR salary LIKE '%$search%' ORDER BY job_id DESC LIMIT $page1,5";
}
else
{
 $query = "
 SELECT job_id,job_title,time,company,location,job_type,salary,experience,recruiter_first,recruiter_last FROM joblist INNER JOIN recruiter ON joblist.recruiter_id= recruiter.recruiter_id ORDER BY job_id DESC LIMIT $page1,5";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
  $output .= '
  <div class="table-responsive-sm">
    <table class="table table-bordered" style="width:1100px;">
      <thead class="text-dark">
        <th>Job ID</th>
        <th>Posted on</th>
        <th>Job Title</th>
        <th>Company</th>
        <th>Location</th>
        <th>Job Type</th>
        <th>Salary</th>
        <th>Experience req.</th>
        <th>Posted by</th>
      </thead>
 ';
  while($row = mysqli_fetch_array($result))
  {
    $output .= '
              <tr class="data text-dark font-weight-normal">
                <td>'.$row["job_id"].'</td>
                <td>'.$row["time"].'</td>
                <td>'.$row["job_title"].'</td>
                <td>'.$row["company"].'</td>
                <td>'.$row["location"].'</td>
                <td>'.$row["job_type"].'</td>
                <td>'.$row["salary"].'</td>
                <td>'.$row["experience"].'</td>
                <td>'.$row["recruiter_first"].' '.$row["recruiter_last"].'</td>';

    $output.=  '</td>
              </tr>';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}


 ?>