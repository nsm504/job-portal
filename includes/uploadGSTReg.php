<?php 
session_start();

include 'dbh.inc.php';
$name='';
if(isset($_SESSION['recId']))
{
	$SESSION = $_SESSION['recId'];

	if($_FILES["file"]["name"] != '')
	{
		$test = explode('.', $_FILES["file"]["name"]);
		$ext = end($test);
		$name = $_FILES['file']['name'];
		$location = '../documents/recruiter/GST registration/'.$name;

		$fetch_doc="SELECT * FROM recruiter_docs WHERE recruiter_id='$SESSION' AND document_type='GST registration'";
		$res_doc=mysqli_query($conn,$fetch_doc);

		if(mysqli_num_rows($res_doc)==0)
		{
			$query = "INSERT INTO recruiter_docs(recruiter_id,name,document_type) VALUES('$SESSION','$name','GST registration')";
			mysqli_query($conn,$query);
		}
		else
		{
			$query = "UPDATE recruiter_docs SET name='$name' WHERE recruiter_id='$SESSION' AND document_type='GST registration'";
			mysqli_query($conn,$query);
		}

		move_uploaded_file($_FILES["file"]["tmp_name"],$location);

		echo '<b><b class="text-success">File uploaded successfully.</b></b>';
	}
}