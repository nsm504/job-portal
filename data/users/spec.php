			 <?php 

 					 
 					

 					if(isset($_SESSION['u_id'])){
 						$SESSION = $_SESSION['u_id'];

						$sql= "SELECT specialization FROM userprofile where user_id='$SESSION'";
						$result = mysqli_query($conn,$sql);

 						if($result->num_rows>0){
							while($row=$result->fetch_assoc())
							{
						  	echo $row["specialization"]; 
							}
					 	}
					}
 		 ?>