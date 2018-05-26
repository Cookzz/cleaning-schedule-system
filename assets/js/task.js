function insert_back_table(message)
{
	var task_data = JSON.parse(message);
	var table = $('#task_table').DataTable();
	table.clear();
	var i = 1;
	task_data.forEach(function(task_data){
		var newRow = table.row.add( [
			i,
			task_data["task"],
			"<button type='button' id='"+task_data["task_id"]+"_update' class='update'>Update</button>",
			"<center><button style='width:80px;height:30px' type='button' id='"+task_data["task_id"]+"_delete' class='w3-text-red fa fa-trash delete'></button></center>"
		]).draw( false ).node();
		i++;
		
		$(newRow).attr("id",task_data["task_id"]);
					
		$("#"+task_data["task_id"]).find('td:eq(1)').attr('id',task_data["task_id"]+"_task");			
		$("#"+task_data["task_id"]).find('td:eq(1)').attr('contenteditable',true);
			
		table.draw( false );
				
	});
}

function postTask()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"taskController/setNewTask";
	var newTask = $("#newTaskField").val();
	var fd = new FormData();
	fd.append('newTask',newTask);

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
				$("#newTaskField").val("");
			}
		}
	});	
}

function delete_task(task_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"taskController/deleteTask";		
	var fd = new FormData();
	fd.append('task_id',task_id);

		
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

function update_task(task_id)
{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"taskController/updateTaskData";
		var update_task = $("#"+task_id+"_task").text().trim();
		var test_update_task = $("#"+task_id+"_task").text();
		console.log(update_task);
		console.log(test_update_task);
		var fd = new FormData();

		fd.append('update_task',update_task);
		fd.append('task_id',task_id);

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
					$("#"+task_id+"_task").text(message);
				}
				
			}
		});
}

$(document).ready(function(){
	
	var i =0;
	
	$('#task_table tfoot th').each( function () {

        var title = $(this).text();
        $(this).html( '<input type="text" id="'+"column_search"+i+'" placeholder="Search '+title+'" />' );
		i++;
    } );
	
	var table = $('#task_table').DataTable({
		"pageLength": 8,
		"info": false,
		"order": [[ 1, "asc" ]],
	});
	
	table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
	
	$("form").submit(function(event){
		event.preventDefault();
		
		postTask();
	
	});
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete the task?"))
		{
			var txt = $(this).attr("id");
			var task_id = txt.match(/\d/g);
			task_id = task_id.join("");
			delete_task(task_id);
		}
		
	});
	
	$(document).on('click','.update',function(){
		if(confirm("Do you confirm want to update the task?"))
		{
			var txt = $(this).attr("id");
			var task_id = txt.match(/\d/g);
			task_id = task_id.join("");
			update_task(task_id);
		}
		
	});
});













