<?php 
	include 'header.php';
	include 'includes/dbh.inc.php';
	include 'nav.php';
 ?>

		<br><br><br><br><br>

		<?php 

			
			$sql="SELECT user_id,highest_qualification,pg_course,course,specialization,percentage FROM details WHERE course IN('BBA/BMS') OR pg_course IN('MBA','PGDM') ";
			$result = mysqli_query($conn,$sql);

		?>
		 		<table class="table" align="center">
					<thead>
						<tr id="trr">

							<th id="thh">Name</th>
							<th id="thh">Mobile</th>
							<th id="thh">Email</th>
							<th id="thh">Qualification</th>
							<th id="thh">PG Course</th>
							<th id="thh">Course</th>
							<th id="thh">Specialization</th>
							<th id="thh">Percentage</th>																		
						</tr>
					</thead>

					<tbody>
							<?php
								while($row = mysqli_fetch_assoc($result)) 
								{ 				
										$user_id=$row["user_id"];	
										$hq=$row["highest_qualification"];
										$pgcourse=$row["pg_course"];
										$course=$row["course"];
										$spec=$row["specialization"];
										$perc=$row["percentage"];

									$sql2="SELECT user_first,user_last,mobile,user_email FROM user WHERE user_id='$user_id' ";
									$result2 = mysqli_query($conn,$sql2);
									while($row2= mysqli_fetch_assoc($result2))
									{


							  ?>
						<tr id="trr">


							<td id="thh"><?php echo $row2["user_first"].' '.$row2["user_last"]; ?></td>
							<td id="thh"><?php echo $row2["mobile"]; ?></td>
							<td id="thh"><?php echo $row2["user_email"]; } ?></td>
							<td id="thh"><?php echo $hq;?></td>
							<td id="thh"><?php echo $pgcourse;?></td>
							<td id="thh"><?php echo $course; ?></td>
							<td id="thh"><?php echo $spec; ?></td>
							<td id="thh"><?php echo $perc; ?></td>
						<?php } ?>
						</tr>

					</tbody>

				</table>
			
</div><br><br>

<?php 
include 'footer.php';
 ?>