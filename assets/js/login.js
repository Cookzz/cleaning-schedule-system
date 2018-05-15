function validateAll_login(dataAndDataFieldArray,errorMessageField,phpUrl)
	{
		$("#preloader").css("display","normal");
		var data = new Array();
		var baseURL = $("#baseURL").val();
		var remember;
		
		if($("#remember").is(":checked"))
		{
			remember = "true";
		}
		else
		{
			remember = "false";
		}
		
		var fd = new FormData();
		
		for(var i = 0 ; i<dataAndDataFieldArray[1].length ; i++)
		{
			data[i] = $(dataAndDataFieldArray[1][i]).val();
			fd.append(dataAndDataFieldArray[0][i], data[i]);
		}
		
		fd.append("remember",remember);
		
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
					$("#preloader").css("display","none");
					$(errorMessageField).html("Incorrect Username or Password");
				}
				else
				{
					$("#preloader").css("display","none");
					window.location.href = baseURL+i;
				}
				
			}
		});
	} 
	
$(document).ready(function(){
	
	var baseURL = $("#baseURL").val();
	var url = baseURL + 'HomeController/viewLoginValidation';
	
	$("#loginForm").submit(function(event){
		event.preventDefault();

		validateAll_login([["user_id","passwords"],["#user_id_field","#password_field"]],"#errorMessage",url,baseURL);
		
	});

});

function logout()
{
	var baseURL = $("#baseURL").val();
	targetUrl = baseURL + "HomeController/viewLogout"
	console.log(targetUrl);
	window.location.href =targetUrl;
}

