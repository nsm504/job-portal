<?php
						if(isset($_SESSION['r_id'])){
 						$SESSION = $_SESSION['r_id'];

						$sql= "SELECT office_addr FROM recruiter where recruiter_id='$SESSION'";
						$result = mysqli_query($conn,$sql);

 						if($result->num_rows>0){
							while($row=$result->fetch_assoc())
							{
						  	echo $row["office_addr"]; 
							}
					 	}
					}


 ?>