function update_complete_duty_data(id)
{
	if(confirm("Do you confirm want to update?"))
	{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"specialDutyController/updateSpecialDutyData";
		var complete_duty_comment = $("#"+id+"_complete_duty_comment").text();
	
		var fd = new FormData();
	
		fd.append('complete_duty_comment',complete_duty_comment);
		fd.append('complete_duty_id',id);
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
	
	$('#complete_duty_table').DataTable({
		"pageLength": 10,
		"order": [[ 7, "desc" ]]
	});
	
	$(document).on('click','.delete',function(){
		var txt = $(this).attr("id");
		var id = txt.match(/\d/g);
		id = id.join("");
		if(confirm("Do you confirm want to delete user data?"))
		{
			var table = $('#complete_duty_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
						

			var baseUrl = $("#baseURL").val();
			var url = baseUrl+"completeDutyController/deleteCompleteDutyData";
			
			var fd = new FormData();
			fd.append('complete_duty_id',id);
		
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
		update_complete_duty_data(id);
	});

});











