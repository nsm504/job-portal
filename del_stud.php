<?php
//including the database connection file
include("includes/dbh.inc.php");

//getting id of the data from url
$uid =$_GET['uid'];

//deleting the row from table
$result = mysqli_query($conn,"DELETE FROM application WHERE user_id=$uid");
//redirecting to the display page (index.php in our case)
header("Location: recjob2.php");

?>