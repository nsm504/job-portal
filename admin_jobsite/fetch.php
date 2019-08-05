<?php
//fetch.php

$table='user';
$id='user_id';
$clause='';

include 'data.php';
$output = '';


if(isset($_POST["user"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["user"]);
 $query = "
  SELECT * FROM user WHERE user_first LIKE '%".$search."%'
  OR user_last LIKE '%".$search."%' 
  OR user_email LIKE '%".$search."%' 
  OR location LIKE '%".$search."%' 
  OR mobile LIKE '%".$search."%' 
  ORDER BY user_id DESC LIMIT $page1,5";
}
else
{
 $query = "
  SELECT * FROM user ORDER BY user_id DESC LIMIT $page1,5
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive-sm">
    <table class="table table-bordered" style="width:1100px;">
      <thead class="text-dark">
        <th>User ID</th>
        <th>Candidate Name</th>
        <th>Location</th>
        <th>Mobile Number</th>
        <th>Email ID</th>
        <th>DoB</th>
        <th>Gender</th>
        <th>Status</th>
        <th>Action</th>
      </thead>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
             <tr class="data text-dark font-weight-normal">
              <td>'.$row["user_id"].'</td>
              <td>'.$row["user_first"].' '.$row["user_last"].'</td>
              <td>'.$row["location"].'</td>
              <td>'.$row["mobile"].'</td>
              <td>'.$row["user_email"].'</td>
              <td>'.$row["dob"].'</td>
              <td>'.$row["gender"].'</td>
              <td class="status">';

              if($row["account_status"]=='Verified')
              {
                $output.= '<span class="verified btn btn-success btn-sm">Verified ✓</span>';
              }
              else if($row["account_status"]=='Confirmed')
              {
                $output.= '<span id="'.$row["user_id"].'" class="confirmed btn btn-info btn-sm">Verification pending</span>';
              }
              else if($row["account_status"]=='Deactivated')
              {
                $output.= '<span class="deactivated btn btn-danger btn-sm px-1">Deactivated X</span>';
              } 

  $output.= ' </td>
              <td>
                <a href="details.php?uid='.$row["user_id"].'"><span id="'.$row["user_id"].'" class="view"><img src="../img/eye1.png"></span></a> &nbsp;';

                if($row["account_status"]=='Deactivated')
                {
                  $output.= '<a href="#"><span id="'.$row["user_id"].'" class="restore"><img src="../img/restore.png"></span></a>';
                }
                else
                {
                  $output.= '<a href="#"><span id="'.$row["user_id"].'" class="deactivate"><img src="../img/delete.png"></span></a>';
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



