$(document).on('submit','#formConfirmRec',function(e)
{
	e.preventDefault();

	$.ajax(
	{
		url:'includes/confirm_rec.php',
		method:'POST',
		data:$('#formConfirmRec').serialize(),
		beforeSend:function()
		{
			$('.sending').html('<b class="ml-50 text-info">Verifying OTP...</b>');
		},
		success:function(result)
		{	
			$('.form-group').attr('hidden','true');
			$('.alert-msg').html(result);
		}
	});
});