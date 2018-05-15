function postChangePasswordData()
{
	$("#preloader").show();
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
				$("#preloader").hide();
				$("#forgotError").text("We have send an email to your email address");
			}
			else
			{
				$("#preloader").hide();
				$("#forgotError").text(message);
			}
		}
	});	
}

$(document).ready(function(){
	$("#preloader").hide();
	$("#forgotForm").submit(function(event){
		event.preventDefault();
		postChangePasswordData();
	});
	
});













