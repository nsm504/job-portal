	$(document).ready(function()
	{

		function fileUpload(property,span,link)
		{
			var file_name= property.name;
			var file_ext=  file_name.split('.').pop().toLowerCase();
			var file_size= parseInt(Math.round(property.size/1024));

			if(jQuery.inArray(file_ext,['docx','doc','pdf'])==-1)
			{
				span.html('<b><b class="text-danger">Invalid file type</b></b>');
			}
			else if(file_size<=1 || file_size>=50)
			{
				span.html('<br><b><b class="text-danger">File size doesnt meet the requirements.</b></b>');
			}
			else
			{
				var formData= new FormData();
				formData.append('file',property);
			   	$.ajax({
				    url:link,
				    method:"POST",
				    data: formData,
				    contentType: false,
				    cache: false,
				    processData: false,
				    success:function(data)
				    {
				     span.html(data);
				    }
   				});
  			}			
		}


		$(document).on('change','#resume',function()
		{
			var pty= document.getElementById('resume').files[0];
			var spanId= $('#span-1');
			var href='../includes/uploadResume.php';

			fileUpload(pty,spanId,href);
		});

		$(document).on('change','#10th',function()
		{
			var pty= document.getElementById('10th').files[0];
			var spanId= $('#span-2');
			var href='../includes/upload10thMarks.php';

			fileUpload(pty,spanId,href);
		});

		$(document).on('change','#12th',function()
		{
			var pty= document.getElementById('12th').files[0];
			var spanId= $('#span-3');
			var href='../includes/upload12thMarks.php';

			fileUpload(pty,spanId,href);
		});

		$(document).on('change','#uni',function()
		{
			var pty= document.getElementById('uni').files[0];
			var spanId= $('#span-4');
			var href='../includes/uploadUniMarks.php';

			fileUpload(pty,spanId,href);
		});

		$(document).on('change','#aadhar',function()
		{
			var pty= document.getElementById('aadhar').files[0];
			var spanId= $('#span-5');
			var href='../includes/uploadAadhar.php';

			fileUpload(pty,spanId,href);
		});


		$(document).on('click','input[value="Finish"]',function()
		{
			if($('#span-1').text()!='File uploaded successfully.' || $('#span-2').text()!='File uploaded successfully.' || $('#span-3').text()!='File uploaded successfully.' || $('#span-4').text()!='File uploaded successfully.' || $('#span-5').text()!='File uploaded successfully.')
			{
				$('.finish').html('<br><br><b><b class="text-danger">Please upload all documents before clicking on Finish button.</b></b>');				
			}
			else
			{
				$('.finish').html('<br><br><b><b class="text-success">Your registration is complete. Verification of account will be completed in 5 working days from today. You will be notified by the administrator through mail and SMS.</b></b><a class="btn btn-info text-white" href="../index.php"><b class="text-white">Proceed to home page</b></a>');	

				/*setTimeout(function()
        		{
            		window.location='../index.php';
        		},3000);*/		
			}
		});

	});

