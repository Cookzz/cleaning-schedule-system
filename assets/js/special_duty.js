function insert_back_table(message)
{
	var special_duty_data = JSON.parse(message);
	var table = $('#special_duty_table').DataTable();
	table.clear();
	console.log("ss");
	var i = 1;
	special_duty_data.forEach(function(special_duty_data){
		var newRow = table.row.add( [
			i,
			special_duty_data["special_duty_detail"],
			special_duty_data["special_duty_time"],
			special_duty_data["special_duty_date"],
			"<button type='button' id='"+special_duty_data["special_duty_id"]+"_modify' class='modify'>Update</button>",
			"<button type='button' id='"+special_duty_data["special_duty_id"]+"_delete' class='delete'>Delete</button>"
		]).draw( false ).node();
		i++;
		
		$(newRow).attr("id",special_duty_data["stuff_id"]);
					
		$("#"+special_duty_data["stuff_id"]).find('td:eq(1)').attr('id',special_duty_data["stuff_id"]+"_special_duty_detail");
		$("#"+special_duty_data["stuff_id"]).find('td:eq(2)').attr('id',special_duty_data["stuff_id"]+"_special_duty_time");
		$("#"+special_duty_data["stuff_id"]).find('td:eq(3)').attr('id',special_duty_data["stuff_id"]+"_special_duty_date");	
				
	});
	table.draw( false );
}

function delete_stuff(special_duty_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"specialDutyController/deleteSpecialDuty";		
	var fd = new FormData();
	fd.append('special_duty_id',special_duty_id);

		
	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message)
		{
			insert_back_table(message);
		}	
	});	
}

$(document).ready(function(){
	
	$('#special_duty_table').DataTable({
		"paging": false,
		"info": false,
		"order": [[ 0, "asc" ]],
	});
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete this special duty?"))
		{
			var txt = $(this).attr("id");
			var special_duty_id = txt.match(/\d/g);
			special_duty_id = special_duty_id.join("");
			delete_stuff(special_duty_id);
		}
		
	});
	
	$(document).on('click','.modify',function(){
		if(confirm("Do you confirm want to update the stuff?"))
		{
			var txt = $(this).attr("id");
			var stuff_id = txt.match(/\d/g);
			stuff_id = stuff_id.join("");
			update_stuff(stuff_id);
		}
		
	});
});













