$(document).on('submit','#myForm',function(e)
{
	e.preventDefault();

	$.ajax({
		url:'includes/contactForm.php',
		method:'POST',
		data:$('#myForm').serialize(),
		beforeSend:function()
		{
			$('.alert-msg').html('Validating information...');
		}
		success:function(result)
		{
			$('.alert-msg').html(result);
		}
	});
});