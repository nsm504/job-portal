$(document).on('submit','#editRecDetails',function(e)
{
	e.preventDefault();

	$.ajax(
	{
		type:'POST',
		url:'../includes/editRecDetails.php',
		data:$('#editRecDetails').serialize(),
		success:function(response)
		{
			$('.details').html(response);
		}
	});
});