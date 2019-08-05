<?php 

$table='applications';
$id='app_id';
$clause='';

include 'data.php';
$output = '';

if(isset($_POST["app"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["app"]);
 $query = "SELECT app_id,joblist.job_title,app_date,joblist.company,user.user_first,user.user_last,status FROM applications INNER JOIN joblist ON applications.job_id= joblist.job_id INNER JOIN user ON applications.user_id= user.user_id WHERE app_date LIKE '%$search%' OR joblist.job_title LIKE '%$search%' OR joblist.company LIKE '%$search%' OR user.user_first LIKE '%$search%' OR user.user_last LIKE '%$search%' OR status LIKE '%$search%' ORDER BY app_id DESC LIMIT $page1,5";
}
else
{
 $query = "SELECT app_id,joblist.job_title,app_date,joblist.company,user.user_first,user.user_last,status FROM applications INNER JOIN joblist ON applications.job_id= joblist.job_id INNER JOIN user ON applications.user_id= user.user_id ORDER BY job_id DESC LIMIT $page1,5";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
  $output .= '
  <div class="table-responsive-sm">
    <table class="table table-bordered" style="width:1100px;">
      <thead class="text-dark">
        <th>App ID</th>
        <th>Date</th>
        <th>Job Title</th>
        <th>Company</th>
        <th>Candidate</th>
        <th>Status</th>
      </thead>
 ';
  while($row = mysqli_fetch_array($result))
  {
    $output .= '
              <tr class="data text-dark font-weight-normal">
                <td>'.$row["app_id"].'</td>
                <td>'.$row["app_date"].'</td>
                <td>'.$row["job_title"].'</td>
                <td>'.$row["company"].'</td>
                <td>'.$row["user_first"].' '.$row["user_last"].'</td>
                <td>'.$row["status"].'</td>';

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