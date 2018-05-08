/**function insert_back_table(message)
{
	var stuff_data = JSON.parse(message);
	$("#stuff_table").empty();
				
	$( "#stuff_table" ).append("<tr><td>No</td><td>Stuff Location</td>");		
				
	var i =1;
	stuff_data.forEach(function(stuff_data){
		$( "#stuff_table" ).append("<tr><td>"+i+"</td>"+
		"<td id='"+stuff_data["stuff_id"]+"_stuff' contenteditable='true'>"+stuff_data["stuff"]+"</td>"+
		"<td><button type='button' id='"+stuff_data["stuff_id"]+"_update' class='update'>Update</button></td>/tr>"+
		"<td><button type='button' id='"+stuff_data["stuff_id"]+"_delete' class='delete'>Delete</button></td>/tr>");
		i++;
	});
}**/

function insert_back_table(message)
{
	var stuff_data = JSON.parse(message);
	var table = $('#stuff_table').DataTable();
	table.clear();
	var i = 1;
	stuff_data.forEach(function(stuff_data){
		var newRow = table.row.add( [
			i,
			stuff_data["stuff"],
			"<button type='button' id='"+stuff_data["stuff_id"]+"_update' class='update'>Update</button>",
			"<button type='button' id='"+stuff_data["stuff_id"]+"_delete' class='delete'>Delete</button>"
		]).draw( false ).node();
		i++;
		
		$(newRow).attr("id",stuff_data["stuff_id"]);
					
		$("#"+stuff_data["stuff_id"]).find('td:eq(1)').attr('id',stuff_data["stuff_id"]+"_stuff");			
		$("#"+stuff_data["stuff_id"]).find('td:eq(1)').attr('contenteditable',true);
			
		table.draw( false );
				
	});
}

function postStuff()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"stuffController/setNewStuff";
	var newStuff = $("#newStuffField").val();
	var fd = new FormData();
	fd.append('newStuff',newStuff);

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
				$("#newStuffField").val("");
			}
		}
	});	
}

function delete_stuff(stuff_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"stuffController/deleteStuff";		
	var fd = new FormData();
	fd.append('stuff_id',stuff_id);

		
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

function update_stuff(stuff_id)
{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"stuffController/updateStuffData";
		var update_stuff = $("#"+stuff_id+"_stuff").text().trim();
		var test_update_stuff = $("#"+stuff_id+"_stuff").text();
		console.log(update_stuff);
		console.log(test_update_stuff);
		var fd = new FormData();

		fd.append('update_stuff',update_stuff);
		fd.append('stuff_id',stuff_id);

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
					$("#"+stuff_id+"_stuff").text(message);
				}
				
			}
		});
}

$(document).ready(function(){
	
	$('#stuff_table').DataTable({
		"paging": false,
		"info": false,
		"order": [[ 1, "asc" ]],
	});
	
	$("form").submit(function(event){
		event.preventDefault();
		
		postStuff();
	
	});
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete the stuff?"))
		{
			var txt = $(this).attr("id");
			var stuff_id = txt.match(/\d/g);
			stuff_id = stuff_id.join("");
			delete_stuff(stuff_id);
		}
		
	});
	
	$(document).on('click','.update',function(){
		if(confirm("Do you confirm want to update the stuff?"))
		{
			var txt = $(this).attr("id");
			var stuff_id = txt.match(/\d/g);
			stuff_id = stuff_id.join("");
			update_stuff(stuff_id);
		}
		
	});
});













