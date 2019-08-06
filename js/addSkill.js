$(document).on('submit','#formSkill',function(e)
{
	e.preventDefault();

	$.ajax(
	{
		type:'POST',
		url:'../includes/addskill.inc.php',
		data:$('#formSkill').serialize(),
		success:function(response)
		{
			$('#skills_table').html(response);
			$('#addSkills').modal('hide');
		}
	});
});