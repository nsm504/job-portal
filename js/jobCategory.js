var category= ['BPO','Banking','Business Operations','Engineering','FMCG',
				'Finance','Hospitality','Information Technology','Manufacturing','Marketing',
				'Media','Pharmacy','Retail','Sales','Services'];

$(document).ready(function()
{
	for(var count=0; count<category.length; count++)
	{
		$('#ind').append('<option>'+category[count]+'</option>');
	}
	
}); 