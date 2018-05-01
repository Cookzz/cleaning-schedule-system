/**function insert_back_table(message)
{
	var duty_data = JSON.parse(message);
	$("#duty_table").empty();
				
	$( "#duty_table" ).append("<td>No.</td><td>Duty Stuff</td><td>Duty Sub Stuff</td>");		
				
	var i =1;
	duty_data.forEach(function(duty_data){
		$( "#duty_table" ).append("<tr><td>"+i+"</td>"+
		"<td id='"+duty_data["duty_id"]+"_stuff' contenteditable='true'>"+duty_data["duty_stuff"]+"</td>"+
		"<td id='"+duty_data["duty_id"]+"_stuff' contenteditable='true'>"+duty_data["duty_sub_stuff"]+"</td>"+
		"<td><button type='button' id='"+duty_data["duty_id"]+"_delete' class='delete'>Delete</button></td>/tr>");
		i++;
	});
}**/

function insert_back_table(message)
{
	var duty_data = JSON.parse(message);
	var table = $('#duty_table').DataTable();
	table.clear();
	var i = 1;
	duty_data.forEach(function(duty_data){
		var newRow = table.row.add( [
			i,
			duty_data["duty_stuff"],
			duty_data["duty_sub_stuff"],
			"<button type='button' id='"+duty_data["duty_id"]+"_delete' class='delete'>Delete</button>"
		]).draw( false ).node();
		i++;
		
		$(newRow).attr("id",duty_data["duty_id"]);
					
		$("#"+duty_data["duty_id"]).find('td:eq(1)').attr('id',duty_data["duty_id"]+"_stuff");			
		$("#"+duty_data["duty_id"]).find('td:eq(1)').attr('contenteditable',true);
		
		$("#"+duty_data["duty_id"]).find('td:eq(2)').attr('id',duty_data["duty_id"]+"_sub_stuff");			
		$("#"+duty_data["duty_id"]).find('td:eq(2)').attr('contenteditable',true);
			
		table.draw( false );
				
	});
}

function postDuty()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"dutyController/setNewDuty";
	var newDuty_stuff = $("#newDuty_stuff").val();
	var newDuty_sub_stuff = $("#newDuty_sub_stuff").val();
	var fd = new FormData();
	fd.append('newDuty_stuff',newDuty_stuff);
	fd.append('newDuty_sub_stuff',newDuty_sub_stuff);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			if(message == false)
			{
				alert("Insert Uncompleted,Invalid or Duplicate Duty");
			}
			else
			{
				alert("Insert Success");
				insert_back_table(message);
				$("#newDuty_sub_stuff").val("");
			}
		}
	});	
	
}

function delete_duty(duty_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"dutyController/deleteDuty";		
	var fd = new FormData();
	fd.append('duty_id',duty_id);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message)
		{
			alert("Delete Success");
			insert_back_table(message);
		}	
	});	
}

$(document).ready(function(){
	
	$('#duty_table').DataTable({
		"paging": false,
		"info": false,
		"order": [[ 1, "asc" ]],
	});
	
	$("form").submit(function(event){
		event.preventDefault();
		
		postDuty();
	
	});
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete the stuff?"))
		{
			var txt = $(this).attr("id");
			var duty_id = txt.match(/\d/g);
			duty_id = duty_id.join("");
			delete_duty(duty_id);
		}
		
	});
});
