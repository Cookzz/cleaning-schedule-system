function validateData()
{
	var oldPassword = $("#oldPassword").val();
	var newPassword = $("#newPassword").val();
	var confirmPassword = $("#confirmPassword").val();
	
	if(newPassword.length < 6)
	{
		$("#changeError").text("The New Password Must More Than 6 Words");
	}
	else if(!(newPassword.match(/^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/)))
	{
		$("#changeError").text("Invalid Symbol Appear, Example @#$!");
	}
	else if(!(newPassword.match(/^.*(?=.{6,})(?=.*[a-zA-Z])[a-zA-Z0-9]+$/)))
	{
		$("#changeError").text("Invalid New Password, Please Include At Least One Letter");
	}
	else if(!(newPassword.match(/^.*(?=.{6,})(?=.*[0-9])[a-zA-Z0-9]+$/)))
	{
		$("#changeError").text("Invalid New Password, Please Include At Least One Number");
	}
	else if((newPassword)!==(confirmPassword))
	{
		$("#changeError").text("The Password does not match");
	}
	else
	{
		postChangePasswordData(oldPassword,newPassword,confirmPassword);
	}
}

function postChangePasswordData(oldPassword,newPassword,confirmPassword)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"changePasswordController/changePassword";
	
	var fd = new FormData();
	fd.append('oldPassword',oldPassword);
	fd.append('newPassword',newPassword);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			if(message == true)
			{
				alert("The New Password Had Been Set");
				location.reload();
			}
			else
			{
				$("#changeError").text(message);
			}
		}
	});	
}

$(document).ready(function(){
	$("#changePassForm").submit(function(event){
		event.preventDefault();
		validateData();
	});
	
});













