$(document).on('submit','#adminLogin',function(e)
{
	e.preventDefault();

	$.ajax(
	{
		type:'POST',
		url:'adminLogin.php',
		data:$('#adminLogin').serialize(),
		success:function(response)
		{
			$('.response').html(response);
			if(response=='<b class="text-success">Login successful.</b>')
			{
				window.location.href='index.php';
			}
		}
	});
});