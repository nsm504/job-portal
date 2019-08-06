$(document).on('submit','#userLogin',function(e)
{
	e.preventDefault();

	$.ajax(
	{
		type:'POST',
		url:'includes/userLogin.php',
		data:$('#userLogin').serialize(),
		success:function(response)
		{
			$('.response').html(response);
			if(response=='<b><b class="text-success">Login successful.</b></b>')
			{
				window.location.href='index.php';
			}
		}
	});
});