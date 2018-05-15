function postChangePasswordData()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"forgotPasswordController/forgotPassword";
	var forgot_user_id = $("#forgot_user_id").val().trim();
	
	var fd = new FormData();
	fd.append('forgot_user_id',forgot_user_id);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			if(message == true)
			{
				alert("ok");
				//location.reload();
			}
			else
			{
				$("#forgotError").text(message);
			}
		}
	});	
}

$(document).ready(function(){
	$("#forgotForm").submit(function(event){
		event.preventDefault();
		postChangePasswordData();
	});
	
});













