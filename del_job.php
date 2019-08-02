<?php
//including the database connection file
include("includes/dbh.inc.php");

//getting id of the data from url
$id = base64_decode($_GET['id']);

//deleting the row from table
$result = mysqli_query($conn,"UPDATE joblist SET job_status='inactive' WHERE job_id=$id");
//redirecting to the display page (index.php in our case)
header("Location: recjob.php");

?>