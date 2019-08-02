<?php 

session_start();
include 'includes/dbh.inc.php';

if(isset($_SESSION['r_id']))
{
	$SESSION = $_SESSION['r_id'];
	if(isset($_POST['but_upload']))
	{
	 
		 $name = $_FILES['file']['name'];
		 $target_dir = "img/profile/";
		 $target_file = $target_dir . basename($_FILES["file"]["name"]);

		 // Select file type
		 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		 // Valid file extensions
		 $extensions_arr = array("jpg","jpeg","png","gif");

		 // Check extension
		 if(in_array($imageFileType,$extensions_arr))
		 {
		 
			  $fetch_doc="SELECT * FROM images WHERE recruiter_id='$SESSION'";
			  $res_doc=mysqli_query($conn,$fetch_doc);

			  if(mysqli_num_rows($res_doc)==0)
			  {
				  $query = "INSERT INTO images(recruiter_id,name) VALUES('$SESSION','$name')";
				  mysqli_query($conn,$query);
			  }
			 else
			 {
			 	$row= mysqli_fetch_assoc($res_doc);
			 	$existing_file= $row["name"];

			 	unlink($target_dir.''.$existing_file);

			 	$query = "UPDATE images SET name='$name' WHERE recruiter_id='$SESSION'";
				mysqli_query($conn,$query);
			 }
	 	 }
	 		move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

		  	header("Location: recruiter/recprof.php");
	 
	}
}

else if(isset($_SESSION['u_id']))
{
	$SESSION = $_SESSION['u_id'];
	if(isset($_POST['but_upload']))
	{
	 
		 $name = $_FILES['file']['name'];
		 $target_dir = "img/profile/";
		 $target_file = $target_dir . basename($_FILES["file"]["name"]);

		 // Select file type
		 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		 // Valid file extensions
		 $extensions_arr = array("jpg","jpeg","png","gif");

		 // Check extension
		 if(in_array($imageFileType,$extensions_arr))
		 {
		 
			$fetch_doc="SELECT * FROM images WHERE user_id='$SESSION'";
			$res_doc=mysqli_query($conn,$fetch_doc);

			if(mysqli_num_rows($res_doc)==0)
			{
				$query = "INSERT INTO images(user_id,name) VALUES('$SESSION','$name')";
				mysqli_query($conn,$query);
			}
			else
			{
			 	$row= mysqli_fetch_assoc($res_doc);
			 	$existing_file= $row["name"];

			 	unlink($target_dir.''.$existing_file);
			 					
			 	$query = "UPDATE images SET name='$name' WHERE user_id='$SESSION'";
				mysqli_query($conn,$query);
			}
		  
		  // Upload file
		  move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
		  echo $name;
		  header("Location: candidate/profile.php");

	 	}
	 	else
	 	{
	 		echo 'Nothing really happened :(';
	 	}
	 
	}
	else
	{
		echo 'Too bad :(';
	}
}
?>

