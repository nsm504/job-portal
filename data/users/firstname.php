<?php 

 					

 					if(isset($_SESSION['u_id'])){
 						$SESSION = $_SESSION['u_id'];

						$sql= "SELECT user_first FROM user where user_id='$SESSION'";
						$result = mysqli_query($conn,$sql);

 						if($result->num_rows>0){
							while($row=$result->fetch_assoc())
							{
						  	echo $row["user_first"]; 
							}
					 	}
					}


 					else if(isset($_SESSION['r_id'])){
 						$SESSION = $_SESSION['r_id'];

						$sql= "SELECT recruiter_first FROM recruiter where recruiter_id='$SESSION'";
						$result = mysqli_query($conn,$sql);

 						if($result->num_rows>0){
							while($row=$result->fetch_assoc())
							{
						  	echo $row["recruiter_first"]; 
							}
					 	}
					}


 ?>