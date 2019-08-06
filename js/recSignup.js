$(document).on('submit','#recSignup',function(e)
{
	e.preventDefault();

	$.ajax({
		method:'POST',
		url:'includes/recSignup.php',
		data: $('#recSignup').serialize(),
		beforeSend:function()
		{
			$('.rec-result').html('<b><b class="text-success">Validating information...</b></b>');
		},
		success:function(response)
		{
			$('.rec-result').html(response);

			if(response=='<b><b class="text-success">Signup successful. Redirecting you to account confirmation...</b></b>')
			{
				window.location.href='confirm_rec.php';
			}
		}
	});

});