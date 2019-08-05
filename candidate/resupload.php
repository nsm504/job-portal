<?php 

session_start();
include '../includes/dbh.inc.php';

if(isset($_SESSION['u_id']))
{
	$SESSION = $_SESSION['u_id'];
	if(isset($_POST['res_upload']))
	{
	 	 $name = $_FILES['resume']['name'];
		 $target_dir = "../documents/";
		 $target_file = $target_dir . basename($_FILES["resume"]["name"]);

		 // Select file type
		 $docFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		 // Valid file extensions
		 $extensions_arr = array("docx","doc","pdf");

		 // Check extension
		 if(in_array($docFileType,$extensions_arr))
		 {
			 
			  // Insert record
			  $fetch_doc="SELECT * FROM user_docs WHERE user_id='$SESSION' AND document_type='resume'";
			  $res_doc=mysqli_query($conn,$fetch_doc);

			  if(mysqli_num_rows($res_doc)==0)
			  {
				  $query = "INSERT INTO user_docs(user_id,name,document_type) VALUES('$SESSION','$name','resume')";
				  mysqli_query($conn,$query);
			 }
			 else
			 {
			 	$query = "UPDATE user_docs SET name='$name' WHERE user_id='$SESSION' AND document_type='resume'";
				mysqli_query($conn,$query);
			 }

			  
			  // Upload file
			  move_uploaded_file($_FILES['resume']['tmp_name'],$target_dir.$name);

			  header("Location: profile.php");
		}

	}
}
?>