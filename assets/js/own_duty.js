function postPendingDuty(pending_duty_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"ownDutyController/completeDuty";
	var pending_duty_id = pending_duty_id;
	
	var fd = new FormData();
	fd.append('pending_duty_id',pending_duty_id);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			console.log('#'+pending_duty_id);
			$('#'+pending_duty_id).attr("disabled", true);
		}
	});	
	
}

$(document).ready(function(){
	
	$(document).on('click','.complete',function(){
		if(confirm("Do you complete the stuff?"))
		{
			var txt = $(this).attr("id");
			var pending_duty_id = txt.match(/\d/g);
			pending_duty_id = pending_duty_id.join("");
			postPendingDuty(pending_duty_id);
		}
		else
		{
			$(this).prop('checked', false);
		}
		
	});
});
