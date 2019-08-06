$(document).on('submit','#editRecProfile',function(e)
{
	e.preventDefault();

	$.ajax(
	{
		type:'POST',
		url:'../includes/editRecProfile.php',
		data:$('#editRecProfile').serialize(),
		success:function(response)
		{
			$('.profile').html(response);
		}
	});
});