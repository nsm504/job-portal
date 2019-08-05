<?php 

$table='recruiter';
$id='recruiter_id';
$clause='';

include 'data.php';
$output = '';

if(isset($_POST["recruiter"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["recruiter"]);
 $query = "
  SELECT * FROM recruiter WHERE recruiter_first LIKE '%".$search."%'
  OR recruiter_last LIKE '%".$search."%' 
  OR recruiter_email LIKE '%".$search."%' 
  OR city LIKE '%".$search."%' 
  OR mobileno LIKE '%".$search."%' 
  ORDER BY recruiter_id DESC LIMIT $page1,5";
}
else
{
 $query = "
  SELECT * FROM recruiter ORDER BY recruiter_id DESC LIMIT $page1,5
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
  $output .= '
  <div class="table-responsive-sm">
    <table class="table table-bordered" style="width:1100px;">
      <thead class="text-dark">
        <th>Recruiter ID</th>
        <th>Recruiter Name</th>
        <th>Location</th>
        <th>Mobile Number</th>
        <th>Email ID</th>
        <th>Status</th>
        <th>Action</th>
      </thead>
 ';
  while($row = mysqli_fetch_array($result))
  {
    $output .= '
              <tr class="data text-dark font-weight-normal">
                <td>'.$row["recruiter_id"].'</td>
                <td>'.$row["recruiter_first"].' '.$row["recruiter_last"].'</td>
                <td>'.$row["city"].'</td>
                <td>'.$row["mobileno"].'</td>
                <td>'.$row["recruiter_email"].'</td>
                <td class="status">';

                if($row["account_status"]=='Verified')
                {
                  $output.= '<span class="verified btn btn-success btn-sm">Verified ✓</span>';
                }
                else if($row["account_status"]=='Confirmed')
                {
                  $output.= '<span id="'.$row["recruiter_id"].'" class="confirmed btn btn-info btn-sm">Verification pending</span>';
                }
                else if($row["account_status"]=='Deactivated')
                {
                  $output.= '<span class="deactivated btn btn-danger btn-sm px-1">Deactivated X</span>';
                } 

    $output.= ' </td>
                <td>
                  <a href="recdetails.php?rid='.$row["recruiter_id"].'"><span id="'.$row["recruiter_id"].'" class="view"><img src="../img/eye1.png"></span></a> &nbsp;';

                  if($row["account_status"]=='Deactivated')
                  {
                    $output.= '<a href="#"><span id="'.$row["recruiter_id"].'" class="restore"><img src="../img/restore.png"></span></a>';
                  }
                  else
                  {
                    $output.= '<a href="#"><span id="'.$row["recruiter_id"].'" class="deactivate"><img src="../img/delete.png"></span></a>';
                  }
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