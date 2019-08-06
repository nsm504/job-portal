$(document).on('submit','#recLogin',function(e)
{
	e.preventDefault();

	$.ajax(
	{
		type:'POST',
		url:'includes/recLogin.php',
		data:$('#recLogin').serialize(),
		success:function(response)
		{
			$('.response-2').html(response);
			if(response=='<b><b class="text-success">Login successful.</b></b>')
			{
				window.location.href='index.php';
			}
		}
	});
});