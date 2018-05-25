function insert_back_table(message)
{
	var sub_task_data = JSON.parse(message);
	var table = $('#sub_task_table').DataTable();
	table.clear();
	var i = 1;
	sub_task_data.forEach(function(sub_task_data){
		var newRow = table.row.add( [
			i,
			sub_task_data["sub_task"],
			"<button type='button' id='"+sub_task_data["sub_task_id"]+"_update' class='update'>Update</button>",
			"<center><button style='width:80px;height:30px' type='button' id='"+sub_task_data["sub_task_id"]+"_delete' class='w3-text-red fa fa-trash delete'></button></center>"
		]).draw( false ).node();
		i++;
		
		$(newRow).attr("id",sub_task_data["sub_task_id"]);
					
		$("#"+sub_task_data["sub_task_id"]).find('td:eq(1)').attr('id',sub_task_data["sub_task_id"]+"_sub_task");			
		$("#"+sub_task_data["sub_task_id"]).find('td:eq(1)').attr('contenteditable',true);
			
		table.draw( false );
				
	});
}

function postTask()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"subTaskController/setNewSubTask";
	var newSubTask = $("#newSubTaskField").val();
	var fd = new FormData();
	fd.append('newSubTask',newSubTask);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			if(message == false)
			{
				alert("Insert Uncompleted,Invalid or Duplicate Task");
			}
			else
			{
				alert("Insert Success");	
				insert_back_table(message);
				$("#newSubTaskField").val("");
			}
		}
	});	
}

function delete_sub_task(sub_task_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"subTaskController/deleteSubTask";		
	var fd = new FormData();
	fd.append('sub_task_id',sub_task_id);

		
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

function update_sub_task(sub_task_id)
{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"subTaskController/updateSubTaskData";
		var update_sub_task = $("#"+sub_task_id+"_sub_task").text().trim();
		var fd = new FormData();
		
		fd.append('update_sub_task',update_sub_task);
		fd.append('sub_task_id',sub_task_id);

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
					$("#"+sub_task_id+"_sub_task").text(message);
				}
				
			}
		});
}

$(document).ready(function(){
	
	$('#sub_task_table').DataTable({
		"paging": false,
		"order": [[ 0, "asc" ]],
		"info":false,
	});
	
	$("form").submit(function(event){
		event.preventDefault();
		
		postTask();
	
	});
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete the task?"))
		{		
			var txt = $(this).attr("id");
			var sub_task_id = txt.match(/\d/g);
			sub_task_id = sub_task_id.join("");
			delete_sub_task(sub_task_id);
		}
		
	});
	
	$(document).on('click','.update',function(){
		if(confirm("Do you confirm want to update the task?"))
		{
			var txt = $(this).attr("id");
			var sub_task_id = txt.match(/\d/g);
			sub_task_id = sub_task_id.join("");
			update_sub_task(sub_task_id);
		}
		
	});
});













