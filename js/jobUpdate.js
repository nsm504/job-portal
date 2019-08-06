$(document).ready(function()
{
	var curr_date= new Date();
	var x='';

	if(curr_date.getDay()==0)			//Send emails every Sunday
	{		
		$.ajax({
			url:'includes/jobUpdate2.php',
			method:'POST',
			data:{jobUpdate:x},
			success:function(result)
			{
				
			}
		});
	}
}); 