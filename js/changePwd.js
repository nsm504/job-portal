	$('#btn-send').on('click',function()
	{
		var email=$('#email').val();

		$.ajax({
			type:'POST',
			url:'changepwd.php',
			data:{email:email},
			beforeSend:function()
			{
				$('.alert-msg').html('<br><b><b class="text-info">Sending OTP to email...</b></b>');
			},
			success:function(response)
			{
				$('#btn-send').hide();
				$('#otp').removeAttr('hidden');
				$('#btn-verify').removeAttr('hidden');
				$('.alert-msg').html('');
			}
		});
	});


	$('#btn-verify').on('click',function()
	{
		var code=$('#code').val();

		$.ajax({
			type:'POST',
			url:'changepwd.php',
			data:{code:code},
			success:function(response)
			{
				$('#mail').hide();
				$('#otp').hide();
				$('#btn-verify').hide();
				$('#pass').removeAttr('hidden');
				$('#btn-change').removeAttr('hidden');
			}
		});
	});

	$('#btn-change').on('click',function()
	{
		var pwd=$('#pwd').val();

		$.ajax({
			type:'POST',
			url:'changepwd.php',
			data:{pwd:pwd},
			beforeSend:function()
			{
				$('.alert-msg').html('<br><b><b class="text-info">Awaiting confirmation....</b></b>');
			},
			success:function(response)
			{
				$('#mail').hide();
				$('#otp').hide();
				$('#btn-verify').hide();
				$('#pass').hide();
				$('#btn-change').hide();
				$('.alert-msg').html('<br><b><b class="text-success">Password has been successfully changed.</b></b>');
			}
		});
	});
