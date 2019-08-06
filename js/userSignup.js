$(document).on('submit','#userSignup',function(e)
{
	e.preventDefault();

	$.ajax(
	{
		type:'POST',
		url:'includes/userSignup.php',
		data:$('#userSignup').serialize(),
		beforeSend:function()
		{
			$('.result').html('<b><b class="text-success">Validating information...</b></b>');
		},
		success:function(response)
		{
			$('.result').html(response);
			if(response=='<b><b class="text-success">Signup successful.</b></b>')
			{
				window.location.href='confirm_user.php';
			}
		}
	});
}); 