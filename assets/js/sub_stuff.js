/**function insert_back_table(message)
{
	var sub_stuff_data = JSON.parse(message);
	$("#sub_stuff_table").empty();
				
	$( "#sub_stuff_table" ).append("<tr><td>No</td><td>Sub Stuff</td>");		
				
	var i =1;
	sub_stuff_data.forEach(function(sub_stuff_data){
		$( "#sub_stuff_table" ).append("<tr><td>"+i+"</td>"+
		"<td id='"+sub_stuff_data["sub_stuff_id"]+"_sub_stuff' contenteditable='true'>"+sub_stuff_data["sub_stuff"]+"</td>"+
		"<td><button type='button' id='"+sub_stuff_data["sub_stuff_id"]+"_update' class='update'>Update</button></td>/tr>"+
		"<td><button type='button' id='"+sub_stuff_data["sub_stuff_id"]+"_delete' class='delete'>Delete</button></td>/tr>");
		i++;
	});
}**/

function insert_back_table(message)
{
	var sub_stuff_data = JSON.parse(message);
	var table = $('#sub_stuff_table').DataTable();
	table.clear();
	var i = 1;
	sub_stuff_data.forEach(function(sub_stuff_data){
		var newRow = table.row.add( [
			i,
			sub_stuff_data["sub_stuff"],
			"<button type='button' id='"+sub_stuff_data["sub_stuff_id"]+"_update' class='update'>Update</button>",
			"<center><button style='width:80px;height:30px' type='button' id='"+sub_stuff_data["sub_stuff_id"]+"_delete' class='w3-text-red fa fa-trash delete'></button></center>"
		]).draw( false ).node();
		i++;
		
		$(newRow).attr("id",sub_stuff_data["sub_stuff_id"]);
					
		$("#"+sub_stuff_data["sub_stuff_id"]).find('td:eq(1)').attr('id',sub_stuff_data["sub_stuff_id"]+"_sub_stuff");			
		$("#"+sub_stuff_data["sub_stuff_id"]).find('td:eq(1)').attr('contenteditable',true);
			
		table.draw( false );
				
	});
}

function postStuff()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"subStuffController/setNewSubStuff";
	var newSubStuff = $("#newSubStuffField").val();
	var fd = new FormData();
	fd.append('newSubStuff',newSubStuff);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			if(message == false)
			{
				alert("Insert Uncompleted,Invalid or Duplicate Stuff");
			}
			else
			{
				alert("Insert Success");	
				insert_back_table(message);
				$("#newSubStuffField").val("");
			}
		}
	});	
}

function delete_sub_stuff(sub_stuff_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"subStuffController/deleteSubStuff";		
	var fd = new FormData();
	fd.append('sub_stuff_id',sub_stuff_id);

		
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

function update_sub_stuff(sub_stuff_id)
{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"subStuffController/updateSubStuffData";
		var update_sub_stuff = $("#"+sub_stuff_id+"_sub_stuff").text().trim();
		var fd = new FormData();
		
		fd.append('update_sub_stuff',update_sub_stuff);
		fd.append('sub_stuff_id',sub_stuff_id);

		$.ajax({
			url: url,
			data: fd,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(message){
				if(message === "Update Success")
				{
					alert(message);
				}
				else
				{
					var data = message;
					alert("Update Incomplete, Duplicate or Invalid Data Appear");
					$("#"+sub_stuff_id+"_sub_stuff").text(message);
				}
				
			}
		});
}

$(document).ready(function(){
	
	$('#sub_stuff_table').DataTable({
		"paging": false,
		"order": [[ 0, "asc" ]],
		"info":false,
	});
	
	$("form").submit(function(event){
		event.preventDefault();
		
		postStuff();
	
	});
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete the stuff?"))
		{		
			var txt = $(this).attr("id");
			var sub_stuff_id = txt.match(/\d/g);
			sub_stuff_id = sub_stuff_id.join("");
			delete_sub_stuff(sub_stuff_id);
		}
		
	});
	
	$(document).on('click','.update',function(){
		if(confirm("Do you confirm want to update the stuff?"))
		{
			var txt = $(this).attr("id");
			var sub_stuff_id = txt.match(/\d/g);
			sub_stuff_id = sub_stuff_id.join("");
			update_sub_stuff(sub_stuff_id);
		}
		
	});
});













