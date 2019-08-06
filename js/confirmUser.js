$(document).on('submit','#formConfirm',function(e)
{
	e.preventDefault();

	$.ajax(
	{
		url:'includes/confirm_user.php',
		method:'POST',
		data:$('#formConfirm').serialize(),
		beforeSend:function()
		{
			$('.sending').html('<b class="ml-50 text-info">Verifying OTP...</b>');
		},
		success:function(result)
		{	
			if(result!='<p class="dark">Invalid OTP</p><br><br><br><br>')
			{
				$('.form-group').attr('hidden','true');	
				$('.alert-msg').html(result);		
			}
			else
			{
				$('.alert-msg').html(result);		
			}
		}
	});
});