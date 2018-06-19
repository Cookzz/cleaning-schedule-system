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
	
	var d= new Date();
	var i =0;
	
	$('#admin_task_table tfoot th').each( function () {

        var title = $(this).text();
        $(this).html( '<input type="text" id="'+"column_search"+i+'" placeholder="Search '+title+'" />' );
		i++;
    } );
	
	var table = $('#task_table').DataTable({
		"pageLength": 10,
		"order": [[ 1, "asc" ]],
		"dom": 'Bfrtip',
        "buttons": [
            {
				extend: 'print',
				autoPrint: true,
                exportOptions: {columns: '0,1'},
				title:'Task Location Table',
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
	
	});
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete the task?"))
		{
			var txt = $(this).attr("id");
			var task_id = txt.match(/\d/g);
			task_id = task_id.join("");
			
			var table = $('#task_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
				
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











