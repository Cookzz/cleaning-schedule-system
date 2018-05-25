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
	
	var d= new Date();
	
	$('#sub_task_table').DataTable({
		"pageLength": 10,
		"order": [[ 1, "asc" ]],
		"dom": 'Bfrtip',
        "buttons": [
            {
				extend: 'print',
				autoPrint: true,
                exportOptions: {columns: '0,1'},
				title:'Subtask Table',
				messageTop:"Print Date : " + d.getDate() + " / " + (d.getMonth()+1) +' / '+ d.getFullYear(),
				customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '12pt' );

 
                    $(win.document.body).find( 'table' )
                        .addClass('compact')
                        .css( 'font-size', 'inherit' );
                }
			}
		]
	});
	
	$("form").submit(function(event){
		event.preventDefault();
	
	});
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete the task?"))
		{		
			var txt = $(this).attr("id");
			var sub_task_id = txt.match(/\d/g);
			sub_task_id = sub_task_id.join("");
			
			var table = $('#sub_task_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
				
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













