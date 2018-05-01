class validateData
{
	constructor() 
	{
	}
	
	validateAll_login(dataAndDataFieldArray,errorMessageField,phpUrl,targetUrl)
	{
		var data = new Array();
		
		var fd = new FormData();
		
		for(var i = 0 ; i<dataAndDataFieldArray[1].length ; i++)
		{
			data[i] = $(dataAndDataFieldArray[1][i]).val();
			fd.append(dataAndDataFieldArray[0][i], data[i]);
		}
		
		$.ajax({
			url:phpUrl,
			type:"POST",
			data: fd,
			processData: false,
			contentType: false,
			success:function(validation)
			{
				var i = validation;
				if(i == false)
				{
					$(errorMessageField).html("Incorrect Username or Password");
				}
				
			}
		});
	} 
}
