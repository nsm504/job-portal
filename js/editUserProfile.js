$(document).on('submit','#editUserProfile',function(e)
{
	e.preventDefault();

	$.ajax(
	{
		type:'POST',
		url:'../includes/editUserProfile.php',
		data:$('#editUserProfile').serialize(),
		success:function(response)
		{
			$('.profile').html(response);
		}
	});
});