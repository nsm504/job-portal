<?php
	$table='joblist';
	$id='job_id';
	$clause='job';

	include 'header.php';
	include 'nav.php';
	include 'data.php';
?>

<div class="mt-20">
	<div align="center">
		<h3>LIST OF JOBS POSTED</h3>
		<div class="p-3">
			<input type="text" name="text_filter" id="filter">
			<input type="submit" name="search" value="Search">
			<button id="job" class="btn btn-sm excel btn-success">Download as Excel File</button>
		</div>
	</div>

	<div class="container result" align="center">
		<div class="table-responsive-sm">
			<table class="table table-bordered" style="width:1100px;">
				<thead class="text-dark">
					<th>Job ID</th>
					<th>Posted on</th>
					<th>Job Title</th>
					<th>Company</th>
					<th>Location</th>
					<th>Job Type</th>
					<th>Salary</th>
					<th>Experience req.</th>
					<th>Posted by</th>
				</thead>

				<?php 

				while($row=mysqli_fetch_array($result))
				{

				?>
				<tr class="text-dark font-weight-normal">
					<td><?php echo $row["job_id"]; ?></td>
					<td><?php echo $row["time"]; ?></td>
					<td><?php echo $row["job_title"]; ?></td>
					<td><?php echo $row["company"]; ?></td>
					<td><?php echo $row["location"]; ?></td>
					<td><?php echo $row["job_type"]; ?></td>
					<td><?php echo $row["salary"]; ?></td>
					<td><?php echo $row["experience"]; ?></td>
					<td><?php echo $row["recruiter_first"].' '.$row["recruiter_last"]; ?></td>
		
					<?php 
						/*if($row["account_status"]=='Confirmed')
						{
							echo '<span class="btn btn-success btn-sm">Verified ✓</span>';
						}
						else if($row["account_status"]=='Not confirmed')
						{
							echo '<span class="btn btn-info btn-sm">Pending ?</span>';
						}
						else if($row["account_status"]=='Deactivated')
						{
							echo '<span class="btn btn-danger btn-sm px-1">Deactivated X</span>';
						}*/
				}
				?>
					
				</tr>

			</table>
			<br>

		</div>

	</div>
		<?php 
	        $res=mysqli_query($conn,"SELECT $id FROM $table ORDER BY $id DESC ");
	        $count=mysqli_num_rows($res);
	        $ceil=ceil($count/5);

	        $middle = (($page+4>$ceil)?$ceil-4:(($page-4<1)?5:$page));
	        $pglink='';
      	?>

			<nav align="center" aria-label="Page navigation example">
		        <ul class="pagination justify-content-center">
			    <?php

			        if($page>=2)
			        {
			           	echo '<li class="page-item"><a class="page-link first" href="?pg=1">First Page</a></li>'; 
			            echo '<li class="page-item"><a class="page-link prev" href="?pg='.($page-1).'">Previous</a></li>';
			       	}
			        if($ceil<9)
					{
						for($i=1;$i<=$ceil;$i++)
						{
							if($i=='')
							{
								if($i==1)
								{	
									echo '<li class="page-item active"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
								}
								else
								{
									echo '<li class="page-item"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
								}
							}
							else if($page==$i)
							{
								echo '<li class="page-item active"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
							}
							else
							{
								echo '<li class="page-item"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
							}
						}
					}
					else
					{
			          	for($i=-4;$i<=4;$i++)
			          	{
			            	if($middle+$i==$page)
			              		$pglink .='<li class="page-item active"><a class="page-link" href="?pg='.($middle+$i).'">'.($middle+$i).'</a></li>';
			            	else
			             	 	$pglink .='<li class="page-item"><a class="page-link" href="?pg='.($middle+$i).'">'.($middle+$i).'</a></li>';
			         	}
			          		echo $pglink;
			        }
			        if($page<$ceil)
			       	{
			            echo '<li class="page-item"><a class="page-link next" href="?pg='.($page+1).'">Next</a></li>'; 
			            echo '<li class="page-item success"><a class="page-link last" href="?pg='.$ceil.'">Last Page</a></li>';
			        }   

			    ?>  
		      	</ul>
	      	</nav>  
</div>



<script type="text/javascript">
	$('#filter').on('keyup',function()
	{
		var ip= $(this).val();
		//$('#user_id').val(ip);

		$.ajax({
			url:'fetchjob.php',
			type:'POST',
			data:{job:ip},
			success:function(result)
			{
				$('.result').html(result);
			}
		});
	});
</script>