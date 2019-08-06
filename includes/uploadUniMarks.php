<?php 
session_start();

include 'dbh.inc.php';
$name='';
if(isset($_SESSION['userId']))
{
	$SESSION = $_SESSION['userId'];

	if($_FILES["file"]["name"] != '')
	{
		$test = explode('.', $_FILES["file"]["name"]);
		$ext = end($test);
		$name = $_FILES['file']['name'];
		$location = '../documents/candidate/university marksheet/'.$name;

		$fetch_doc="SELECT * FROM user_docs WHERE user_id='$SESSION' AND document_type='university marksheet'";
		$res_doc=mysqli_query($conn,$fetch_doc);

		if(mysqli_num_rows($res_doc)==0)
		{
			$query = "INSERT INTO user_docs(user_id,name,document_type) VALUES('$SESSION','$name','university marksheet')";
			mysqli_query($conn,$query);
		}
		else
		{
			$query = "UPDATE user_docs SET name='$name' WHERE user_id='$SESSION' AND document_type='university marksheet'";
			mysqli_query($conn,$query);
		}

		move_uploaded_file($_FILES["file"]["tmp_name"], $location);

		echo '<b><b class="text-success">File uploaded successfully.</b></b>';
	}
}