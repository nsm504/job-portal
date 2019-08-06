$(document).on('submit','#editUserDetails',function(e)
{
	e.preventDefault();

	$.ajax(
	{
		type:'POST',
		url:'../includes/editUserDetails.php',
		data:$('#editUserDetails').serialize(),
		success:function(response)
		{
			$('.userdetails').html(response);
		}
	});
});