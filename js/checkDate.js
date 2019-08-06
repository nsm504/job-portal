$(document).ready(function()
{
	var x='';
	$.ajax({
		url:'includes/checkDate.php',
		method:'POST',
		data:{checkDate:x},
		success:function(result)
		{
			
		}
	});
});