function update_user_data(id)
{
	if(confirm("Do you confirm want to update?"))
	{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"pendingDutyController/updatePendingDutyData";
		var pending_duty_comment = $("#"+id+"_pending_duty_comment").text();
	
		var fd = new FormData();
	
		fd.append('pending_duty_comment',pending_duty_comment);
		fd.append('pending_duty_id',id);

		$.ajax({
			url: url,
			data: fd,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(message){
				if(message == true)
				{
					alert("Update Completed");
				}
			}
		});
	}
}

$(document).ready(function(){
	
	$('#pending_duty_table').DataTable({
		"pageLength": 10,
		"order": [[ 7, "desc" ]]
	});
	
	$(document).on('click','.delete',function(){
		var txt = $(this).attr("id");
		var id = txt.match(/\d/g);
		id = id.join("");
		if(confirm("Do you confirm want to delete user data?"))
		{
			var table = $('#pending_duty_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
						

			var baseUrl = $("#baseURL").val();
			var url = baseUrl+"pendingDutyController/deletePendingDutyData";
			
			var fd = new FormData();
			fd.append('pending_duty_id',id);
		
			$.ajax({
			url: url,
			data: fd,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(message)
			{
				if(message)
				{
					alert("Delete Success");
				}
			}
			
			});	
		}
		else
		{}
	});
	
	$(document).on('click','.update',function(){
		var txt = $(this).attr("id");
		var id = txt.match(/\d/g);
		id = id.join("");
		update_user_data(id);
	});

});











