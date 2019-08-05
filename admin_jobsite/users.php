<?php
	$table='user';
	$id='user_id';
	$clause='';

	include 'header.php';
	include 'nav.php';
	include 'data.php';
?>

<div class="mt-20 main">
	<div align="center">
		<h3>REGISTERED CANDIDATES</h3>
			<div class="p-3">
				<input type="text" name="text_filter" id="filter">
				<input type="submit" name="search" value="Search">
				<button id="user" class="btn btn-sm excel btn-success">Download as Excel File</button>
			</div>
	</div>
	<div class="container result" align="center">
		<div class="table-responsive-sm">
			<table class="table table-bordered" style="width:1100px;">
				<thead class="text-dark">
					<th>User ID</th>
					<th>Candidate Name</th>
					<th>Location</th>
					<th>Mobile Number</th>
					<th>Email ID</th>
					<th>DoB</th>
					<th>Gender</th>
					<th>Status</th>
					<th>Action</th>
				</thead>

				<?php 

				while($row=mysqli_fetch_array($result))
				{

				?>
				<tr class="data text-dark font-weight-normal">
					<td><?php echo $row["user_id"]; ?></td>
					<td><?php echo $row["user_first"].' '.$row["user_last"]; ?></td>
					<td><?php echo $row["location"]; ?></td>
					<td><?php echo $row["mobile"]; ?></td>
					<td><?php echo $row["user_email"]; ?></td>
					<td><?php echo $row["dob"]; ?></td>
					<td><?php echo $row["gender"]; ?></td>
					<td class="status">
					<?php 
						if($row["account_status"]=='Verified')
						{
							echo '<span class="verified btn btn-success btn-sm">Verified ✓</span>';
						}
						else if($row["account_status"]=='Confirmed')
						{
							echo '<span id="'.$row["user_id"].'" class="confirmed btn btn-info btn-sm">Verification pending</span>';
						}
						else if($row["account_status"]=='Deactivated')
						{
							echo '<span class="deactivated btn btn-danger btn-sm px-1">Deactivated X</span>';
						}
					?>
					</td>
					<td>
						<a href="details.php?uid=<?php echo $row["user_id"];  ?>"><span id="<?php echo $row["user_id"]; ?>" class="view"><img src="../img/eye1.png"></span></a>
						&nbsp;
						<?php 
							if($row["account_status"]=='Deactivated')
							{
								echo '<span id="'.$row["user_id"].'" class="restore"><img src="../img/restore.png"></span>';
							}
							else
							{
								echo '<span id="'.$row["user_id"].'" class="deactivate"><img src="../img/delete.png"></span>';
							}
						?>
					</td>
				<?php
				}
				?>
					
				</tr>

			</table>
			<br>

		</div>

	</div>
		<?php 
	        $res=mysqli_query($conn,"SELECT * FROM $table ORDER BY $id DESC ");
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

	      	<input type="hidden" name="user_id" id="user_id">
</div>


<script type="text/javascript">
	
	$(document).on('click','.confirmed',function()
	{
		var user_id= $(this).attr('id');
		var record=$(this);

		if(confirm('Are you sure you want to verify the following account ?')==true)
		{
			$.ajax({
				url:'users_action.php',
				type:'POST',
				data:{user_id:user_id},
				beforeSend:function()
				{
					record.html('Completing verification...');
				},
				success:function(result)
				{
					record.html('Verified ✓');
					record.css('background-color','#28a745');
					record.css('border','none');
				}
			});					
		}
	});

	$(document).on('click','.deactivate',function()
	{
		var user_id= $(this).attr('id');
		var record=$(this).parents('td').siblings('.status').children('.verified,.confirmed');
		var img= $(this).children('img');

		if(confirm('Are you sure you want to deactivate the following account ?')==true)
		{
			$.ajax({
				url:'users_action.php',
				type:'POST',
				data:{deactivate:user_id},
				success:function(result)
				{
					record.html('Deactivated X');
					record.css('background-color','#dc3545');
					record.css('border','none');
					img.attr('src','../img/restore.png');
				}
			});					
		}
	});

	$(document).on('click','.restore',function()
	{
		var user_id= $(this).attr('id');
		var record=$(this).parents('td').siblings('.status').children('.deactivated');
		var img= $(this).children('img');

		if(confirm('Are you sure you want to restore the following account ?')==true)
		{
			$.ajax({
				url:'users_action.php',
				type:'POST',
				data:{restore:user_id},
				success:function(result)
				{
					record.html('Verification pending');
					record.css('background-color','#17a2b8');
					record.css('border','none');
					record.css('padding','0.25rem 0.5rem');
					img.attr('src','../img/delete.png');
				}
			});					
		}
	});

	$('#filter').on('keyup',function()
	{
		var ip= $(this).val();
		//$('#user_id').val(ip);

		$.ajax({
			url:'fetch.php',
			type:'POST',
			data:{user:ip},
			success:function(result)
			{
				$('.result').html(result);
			}
		});
	});


	$('#user').on('click',function()
	{
		window.location.href='export.php?user';
	});

</script>


